<?php

namespace App\Repositories\Frontend;

use App\Helpers\ImageHelper;
use App\Models\Subscriber;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserRepository{

    public function register($request)
    {
        $input = $request->all();
        $user = new User();
        $user->email = $input['email'];
        $user->password = bcrypt($request->password);
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->phone = $input['phone'];
        $verify = Str::random(6);
        $input['email_token'] = $verify;
        unset($input['password']);
        $user->fill($input)->save();
    }

    public function profileUpdate($request)
    {
        $input = $request->all();

        if ($request->user_id) {
            $user = User::findOrFail($request->user_id);
        } else {
            $user = Auth::user();
        }

        if ($request->password) {
            $input['password'] = bcrypt($input['password']);
            $user->password = $input['password'];
            $user->update();
        }
        unset($input['password']);

        if ($file = $request->file('photo')) {
            $input['photo'] = ImageHelper::handleUpdatedUploadedImage($file, 'uploads/profile', $user, 'photo');
        }

        if ($request->newsletter) {
            if (!Subscriber::where('email', $user->email)->exists()) {
                Subscriber::insert([
                    'email' => $user->email
                ]);
            }
        } else {
            Subscriber::where('email', $user->email)->delete();
        }

        $user->fill($input)->save();
    }
}
