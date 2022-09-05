<?php

namespace App\Http\Controllers\User;

use App\Helpers\EmailHelper;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\SocialProvider;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Pipeline\Hub;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    public function __construct() {
        $setting = Setting::first();

        Config::set('services.google.client_id', $setting->google_client_id);
        Config::set('services.google.client_secret', $setting->google_client_secret);
        Config::set('services.google.redirect', url('auth/google/callback'));

        Config::set('services.twitter.client_id', $setting->twitter_client_id);
        Config::set('services.twitter.client_secret', $setting->twitter_client_secret);
        Config::set('services.twitter.redirect', url('auth/twitter/callback'));

        Config::set('services.facebook.client_id', $setting->facebook_client_id);
        Config::set('services.facebook.client_secret', $setting->facebook_client_secret);
        Config::set('services.facebook.redirect', url('auth/facebook/callback'));
    }

    /**
     * Redirect to social login platform
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
    */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $social_user = Socialite::driver($provider)->user();
        } catch (\Throwable $th) {
            return redirect('/');
        }

        // Check if we have logged provider
        $social_provider = SocialProvider::where('provider_id', $social_user->getId())->first();
        if (!$social_provider) {
            if (User::where('email', $social_user->email)->exists()) {
                $auth_user = User::where('email', $social_user->email)->first();
                Auth::login($auth_user);
                return redirect()->route('user.dashboard');
            }

            // Create a new user and provider

            $name = $this->splitName($social_user->name);

            $user = new User();
            $user->email  = $social_user->email;
            $user->password  = bcrypt($social_user->email);
            $user->first_name  = $name[0];
            $user->last_name  = $name[1];
            $user->save();

            $user->socialProviders()->create([
                'provider_id' => $social_user->getId(),
                'provider'    => $provider
            ]);

            Notification::create([
                'user_id' => $user->id
            ]);

            $email_data = [
                'to' => $user->email,
                'type' => 'Registration',
                'user_name' => $user->displayName(),
                'order_cost' => '',
                'transaction_number' => '',
                'site_title' => Setting::first()->title
            ];

            $email = new EmailHelper();
        } else {
            if (User::where('email', $social_user->email)->exists()) {
                $auth_user = User::where('email', $social_user->email)->first();
                Auth::guard('web')->login($auth_user);
                return redirect()->route('user.dashboard');
            }

            $user = $social_provider->user;
        }

        Auth::login($user);
        return redirect()->route('user.dashboard');
    }

    /**
     * Split name
     *
     * @param string $name
     * @return \Illuminate\Http\Response
    */
    public function splitName($name)
    {
        $name = trim($name);
        $last_name = (strpos($name, '') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
        $first_name = trim(preg_replace('#' . $last_name . '#', '', $name));
        return array($first_name, $last_name);
    }
}
