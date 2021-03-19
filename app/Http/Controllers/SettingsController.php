<?php

namespace App\Http\Controllers;

use App\Mail\EmailTest;
use App\Workspace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function index()
    {
        $user = \Auth::user();
        if($user->type == 'admin')
        {
            $workspace = new Workspace();

            return view('setting', compact('workspace'));
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function store(Request $request)
    {
        $user = \Auth::user();
        if($user->type == 'admin')
        {
            if($request->favicon)
            {
                $request->validate(['favicon' => 'required|image|mimes:png|max:204800']);
                $request->favicon->storeAs('logo', 'favicon.png');
            }
            if($request->blue_logo)
            {
                $request->validate(['blue_logo' => 'required|image|mimes:png|max:204800']);
                $request->logo->storeAs('logo', 'logo-blue.png');
            }
            if($request->white_logo)
            {
                $request->validate(['white_logo' => 'required|image|mimes:png|max:204800']);
                $request->logo->storeAs('logo', 'logo-white.png');
            }

            $rules = [
                'app_name' => 'required|string|max:50',
                'default_language' => 'required|string|max:50',
                'footer_text' => 'required|string|max:50',
            ];

            $request->validate($rules);

            $arrEnv = [
                'APP_NAME' => $request->app_name,
                'DEFAULT_LANG' => $request->default_language,
                'FOOTER_TEXT' => $request->footer_text,
                'DISPLAY_LANDING' => $request->display_landing ?? 'off',
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function emailSettingStore(Request $request)
    {
        $user = \Auth::user();
        if($user->type == 'admin')
        {
            $rules = [
                'mail_driver' => 'required|string|max:50',
                'mail_host' => 'required|string|max:50',
                'mail_port' => 'required|string|max:50',
                'mail_username' => 'required|string|max:50',
                'mail_password' => 'required|string|max:255',
                'mail_encryption' => 'required|string|max:50',
                'mail_from_address' => 'required|string|max:50',
                'mail_from_name' => 'required|string|max:50',
            ];

            $request->validate($rules);

            $arrEnv = [
                'MAIL_HOST' => $request->mail_host,
                'MAIL_PORT' => $request->mail_port,
                'MAIL_USERNAME' => $request->mail_username,
                'MAIL_PASSWORD' => $request->mail_password,
                'MAIL_ENCRYPTION' => $request->mail_encryption,
                'MAIL_FROM_ADDRESS' => $request->mail_from_address,
                'MAIL_FROM_NAME' => $request->mail_from_name,
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function paymentSettingStore(Request $request)
    {
        $user = \Auth::user();
        if($user->type == 'admin')
        {
            $rules = [
                'currency' => 'required|string|max:50',
                'currency_symbol' => 'required|string|max:50',
            ];

            $stripe_status = $request->enable_stripe ?? 'off';
            $paypal_status = $request->enable_paypal ?? 'off';

            if($stripe_status == 'on')
            {
                $rules['stripe_key']            = 'required|string|max:255';
                $rules['stripe_secret']         = 'required|string|max:255';
                $rules['stripe_webhook_secret'] = 'required|string|max:255';
            }

            if($paypal_status == 'on')
            {
                $rules['paypal_client_id']  = 'required|string|max:255';
                $rules['paypal_secret_key'] = 'required|string|max:255';
            }

            if($request->enable_chat == 'yes')
            {
                $rules['pusher_app_id']      = 'required|string|max:50';
                $rules['pusher_app_key']     = 'required|string|max:50';
                $rules['pusher_app_secret']  = 'required|string|max:50';
                $rules['pusher_app_cluster'] = 'required|string|max:50';
            }

            $request->validate($rules);

            $arrEnv = [
                'CURRENCY_SYMBOL' => $request->currency_symbol,
                'CURRENCY' => $request->currency,
                'ENABLE_STRIPE' => $stripe_status,
                'STRIPE_KEY' => $request->stripe_key,
                'STRIPE_SECRET' => $request->stripe_secret,
                'STRIPE_WEBHOOK_SECRET' => $request->stripe_webhook_secret,
                'ENABLE_PAYPAL' => $paypal_status,
                'PAYPAL_MODE' => $request->paypal_mode,
                'PAYPAL_CLIENT_ID' => $request->paypal_client_id,
                'PAYPAL_SECRET_KEY' => $request->paypal_secret_key,
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public function pusherSettingStore(Request $request)
    {
        $user = \Auth::user();
        if($user->type == 'admin')
        {
            $rules = [];

            if($request->enable_chat == 'yes')
            {
                $rules['pusher_app_id']      = 'required|string|max:50';
                $rules['pusher_app_key']     = 'required|string|max:50';
                $rules['pusher_app_secret']  = 'required|string|max:50';
                $rules['pusher_app_cluster'] = 'required|string|max:50';
            }

            $request->validate($rules);

            $arrEnv = [
                'CHAT_MODULE' => $request->enable_chat,
                'PUSHER_APP_ID' => $request->pusher_app_id,
                'PUSHER_APP_KEY' => $request->pusher_app_key,
                'PUSHER_APP_SECRET' => $request->pusher_app_secret,
                'PUSHER_APP_CLUSTER' => $request->pusher_app_cluster,
            ];

            if($this->setEnvironmentValue($arrEnv))
            {
                return redirect()->back()->with('success', __('Setting updated successfully'));
            }
            else
            {
                return redirect()->back()->with('error', __('Something is wrong'));
            }
        }
        else
        {
            return redirect()->back()->with('error', __('Something is wrong'));
        }
    }

    public static function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);
        if(count($values) > 0)
        {
            foreach($values as $envKey => $envValue)
            {
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if(!$keyPosition || !$endOfLinePosition || !$oldLine)
                {
                    $str .= "{$envKey}='{$envValue}'\n";
                }
                else
                {
                    $str = str_replace($oldLine, "{$envKey}='{$envValue}'", $str);
                }
            }
        }
        $str = substr($str, 0, -1);
        $str .= "\n";

        return file_put_contents($envFile, $str) ? true : false;
    }

    public function testEmail(Request $request)
    {
        $user = \Auth::user();

        if($user->type == 'admin')
        {
            $data                    = [];
            $data['mail_driver']     = $request->mail_driver;
            $data['mail_host']       = $request->mail_host;
            $data['mail_port']       = $request->mail_port;
            $data['mail_username']   = $request->mail_username;
            $data['mail_password']   = $request->mail_password;
            $data['mail_encryption'] = $request->mail_encryption;

            return view('users.test_email', compact('data'));
        }
        else
        {
            return response()->json(['error' => __('Permission Denied.')], 401);
        }
    }

    public function testEmailSend(Request $request)
    {
        $validator = \Validator::make(
            $request->all(), [
                               'email' => 'required|email',
                               'mail_driver' => 'required',
                               'mail_host' => 'required',
                               'mail_port' => 'required',
                               'mail_username' => 'required',
                               'mail_password' => 'required',
                           ]
        );
        if($validator->fails())
        {
            $messages = $validator->getMessageBag();

            return redirect()->back()->with('error', $messages->first());
        }

        try
        {
            config(
                [
                    'mail.driver' => $request->mail_driver,
                    'mail.host' => $request->mail_host,
                    'mail.port' => $request->mail_port,
                    'mail.encryption' => $request->mail_encryption,
                    'mail.username' => $request->mail_username,
                    'mail.password' => $request->mail_password,
                    'mail.from.address' => $request->mail_username,
                    'mail.from.name' => config('name'),
                ]
            );
            Mail::to($request->email)->send(new EmailTest());
        }
        catch(\Exception $e)
        {
            return response()->json(
                [
                    'is_success' => false,
                    'message' => $e->getMessage(),
                ]
            );
        }

        return response()->json(
            [
                'is_success' => true,
                'message' => __('Email send Successfully'),
            ]
        );
    }

}
