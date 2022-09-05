<?php

namespace App\Helpers;

use App\Models\Setting;
use Twilio\Rest\Client;

class SmsHelper {

    public function sendSms($to_number, $type)
    {
        $setting = Setting::first();
        $code = str_split($setting->twillio_country_code);
        array_pop($code);

        $new_code = implode('', $code);
        $sms_section = json_decode($setting->twillio_section, true);

        try {
            $account_sid = $setting->twillio_sid;
            $auth_token = $setting->twillio_token;
            $twillio_number = $setting->twillio_form_number;

            $client = new Client($account_sid, $auth_token);
            $message = $client->messages->create(
                $new_code . $to_number,
                array(
                    'from' => $twillio_number,
                    'body' => $sms_section[$type]
                )
            );
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
