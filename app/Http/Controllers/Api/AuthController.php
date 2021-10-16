<?php

namespace App\Http\Controllers\Api;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Otp;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use SoapClient;


class AuthController extends Controller
{

    public function lol()
    {


        $mobile = "01717849968";
        $sms = "hello";
        try {
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'userName' => "01717849968",
                'userPassword' => "acdd53898d",
                'mobileNumber' => $mobile,
                'smsText' => $sms,
                'type' => "TEXT",
                'maskName' => '',
                'campaignName' => '',
            );
            $value = $soapClient->__call("OneToOne", array($paramArray));

            return 1;

        } catch (\Exception $exception) {

            return $exception->getMessage();
            return 0;
            //echo $e->getMessage();
            //echo '{"status" : "sms_send_decline", "message": "' . $e->getMessage() . '"}';
        }


        /* $mobile = "01717849968";
         $sms = "hello";
         // set post fields
         $post= array(
             'userName' => "01717849968",
             'userPassword' => "acdd53898d",
             'mobileNumber' => $mobile,
             'smsText' => $sms,
             'type' => "TEXT",
             'maskName' => '',
             'campaignName' => '',
         );

         $ch = curl_init('https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl');
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

 // execute!
         $response = curl_exec($ch);

 // close the connection, release resources used
         curl_close($ch);

 // do anything you want with your response
         var_dump($response);

         return;*/


        $mobile = "01717849968";
        $sms = "hello";
        try {
            $soapClient = new SoapClient("https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl");
            $paramArray = array(
                'userName' => "01717849968",
                'userPassword' => "acdd53898d",
                'mobileNumber' => $mobile,
                'smsText' => $sms,
                'type' => "TEXT",
                'maskName' => '',
                'campaignName' => '',
            );
            $value = $soapClient->__call("OneToOne", array($paramArray));

            return 1;

        } catch (\Exception $exception) {

            return $exception->getMessage();
            return 0;
            //echo $e->getMessage();
            //echo '{"status" : "sms_send_decline", "message": "' . $e->getMessage() . '"}';
        }


        $paramArray = array(
            'userName' => "01717849968",
            'userPassword' => "acdd53898d",
            'mobileNumber' => $mobile,
            'smsText' => $sms,
            'type' => "TEXT",
            'maskName' => '',
            'campaignName' => '',
        );

        return $response = Http::post('https://api2.onnorokomSMS.com/sendSMS.asmx?wsdl', $paramArray);


    }

    public function login(Request $request)
    {


        //return $request->all();
        $status_code = 200;
        $message = "Successfully Retrieved";
        $datas = [];
        $access_token = null;
        $credentials = [
            'customer_phone' => $request['customer_phone'],
            'password' => $request['password'],
        ];
        if (Auth::guard('is_customer')->attempt($credentials)) {
            $datas = Auth::guard('is_customer')->user();
            if (is_null($datas)) {
                $status_code = 400;
                $message = "User not found";
                return getApiErrorResponse($status_code, $message, $request->all());
            }


            $access_token = $datas->createToken('QC')->accessToken;
        } else {

            $status_code = 400;
            $message = "User name or password is wrong.";
            return getApiErrorResponse($status_code, $message, $request->all());
        }

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $datas
        ];
    }

    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "customer_name" => 'required',
            "customer_phone" => 'required|unique:customers',
            "customer_password" => 'required'
        ]);

        if ($validator->fails()) {
            return getApiErrorResponse(400, "Validation failed", $request->all());
        }

        try {
            $customer_array = [
                "customer_name" => $request['customer_name'],
                "customer_phone" => $request['customer_phone'],
                "customer_password" => Hash::make($request['customer_password'])
            ];
            Customer::create($customer_array);

            //Session set
            $credentials = [
                'customer_phone' => $request['customer_phone'],
                'password' => $request['customer_password'],
            ];
            if (Auth::guard('is_customer')->attempt($credentials)) {
                //return redirect($request['last_page']);
            }

            $message = "Successfully Registered, Keep shopping with us";
            $status_code = 200;

        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $status_code = 400;
        }
        return getApiErrorResponse($status_code, $message, $request->all());
    }


    public function createAccountGenerateOtp(Request $request)
    {

        $status_code = 200;
        $message = "Success";

        $is_valid = validatePhoneNumber($request['phone_number']);
        if ($is_valid == 0) {
            $message = "Invalid Phone Number";
            return getApiErrorResponse(400, $message, $request->all());
        }

        $is_account_exist = Customer::where('customer_phone', $request['phone_number'])->first();
        if (!is_null($is_account_exist)) {
            $message = "Already have an account with this Phone Number";
            return getApiErrorResponse(400, $message, $request->all());

        }
        $otp = getOtp();

        $is_exist = Otp::where('phone_number', $request['phone_number'])->where('is_used', false)->orderBy('created_at', 'DESC')->first();
        if (!is_null($is_exist)) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) >= \Carbon\Carbon::now()) {
                $message = "You have an active OTP";
                $status_code = 400;
                $otp = $is_exist->otp;
            } else {
                $status_code = 200;
                $message = "Check your inbox for OTP.";
                Otp::create([
                    'phone_number' => $request['phone_number'],
                    'otp' => $otp,
                ]);
                $message = "Check your inbox for OTP.";
                $sms = "Your MartVenue verification code is " . $otp;
                $sms_status = sendSms($request['phone_number'], $sms);
                $request['sms_status'] = $sms_status;
            }
        } else {
            $status_code = 200;
            $message = "Check your inbox for OTP.";

            $sms = "Your MartVenue verification code is " . $otp;
            $sms_status = sendSms($request['phone_number'], $sms);
            $request['sms_status'] = $sms_status;
            Otp::create([
                'phone_number' => $request['phone_number'],
                'otp' => $otp,
            ]);
        }
        $request['otp'] = $otp;
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'timer' => getExpireLimit(),
            'message' => $message,
            'data' => $request->all()
        ];

    }

    public function generateOtp(Request $request)
    {

        $status_code = 200;
        $message = "Success";
        if ($request['api_from'] == "android") {
            $phone_number = $request['data']['customer_phone'];
        } else {
            $phone_number = $request['customer_phone'];
        }


        $is_valid = validatePhoneNumber($phone_number);
        if ($is_valid == 0) {
            $message = "Invalid Phone Number";
            return getApiErrorResponse(400, $message, $request->all());
        }

        $is_account_exist = Customer::where('customer_phone', $phone_number)->first();
        if (is_null($is_account_exist)) {
            $message = "This number is not associated with any Account";
            return getApiErrorResponse(400, $message, $request->all());
        }
        $otp = getOtp();

        $is_exist = Otp::where('phone_number', $phone_number)->where('is_used', false)->orderBy('created_at', 'DESC')->first();
        if (!is_null($is_exist)) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) >= \Carbon\Carbon::now()) {
                $message = "You have an active OTP";
                $status_code = 400;
                $otp = $is_exist->otp;
            } else {
                $status_code = 200;
                $message = "Check your inbox for OTP.";
                Otp::create([
                    'phone_number' => $phone_number,
                    'otp' => $otp,
                ]);
                $message = "Check your inbox for OTP.";
                $sms = "Your MartVenue verification code is " . $otp;
                $sms_status = sendSms($phone_number, $sms);
            }
        } else {
            $status_code = 200;
            $message = "Check your inbox for OTP.";

            $sms = "Your MartVenue verification code is " . $otp;
            sendSms($phone_number, $sms);
            Otp::create([
                'phone_number' => $phone_number,
                'otp' => $otp,
            ]);
        }
        $request['otp'] = $otp;
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'timer' => getExpireLimit(),
            'message' => $message,
            'data' => $request->all()
        ];

    }
    public function MerchantGenerateOtp(Request $request)
    {

        $status_code = 200;
        $message = "Success";
        if ($request['api_from'] == "android") {
            $phone_number = $request['data']['customer_phone'];
        } else {
            $phone_number = $request['phone'];
        }


        $is_valid = validatePhoneNumber($phone_number);
        if ($is_valid == 0) {
            $message = "Invalid Phone Number";
            return getApiErrorResponse(400, $message, $request->all());
        }

        $is_account_exist = User::where('phone', $phone_number)->first();
        if (is_null($is_account_exist)) {
            $message = "This number is not associated with any Account";
            return getApiErrorResponse(400, $message, $request->all());
        }
        $otp = getOtp();

        $is_exist = Otp::where('phone_number', $phone_number)->where('is_used', false)->orderBy('created_at', 'DESC')->first();
        if (!is_null($is_exist)) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) >= \Carbon\Carbon::now()) {
                $message = "You have an active OTP";
                $status_code = 400;
                $otp = $is_exist->otp;
            } else {
                $status_code = 200;
                $message = "Check your inbox for OTP.";
                Otp::create([
                    'phone_number' => $phone_number,
                    'otp' => $otp,
                ]);
                $message = "Check your inbox for OTP.";
                $sms = "Your MartVenue verification code is " . $otp;
                $sms_status = sendSms($phone_number, $sms);
            }
        } else {
            $status_code = 200;
            $message = "Check your inbox for OTP.";

            $sms = "Your MartVenue verification code is " . $otp;
            sendSms($phone_number, $sms);
            Otp::create([
                'phone_number' => $phone_number,
                'otp' => $otp,
            ]);
        }
        $request['otp'] = $otp;
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'timer' => getExpireLimit(),
            'message' => $message,
            'data' => $request->all()
        ];

    }


    public function checkOtp(Request $request)
    {

        $status_code = 200;
        $message = "Valid OTP";
        if ($request['api_from'] == "android") {
            $phone_number = $request['data']['customer_phone'];
        } else {
            $phone_number = $request['phone_number'];
        }

        $is_exist = Otp::where('phone_number', $phone_number)->where('otp', $request['otp'])->first();
        if (!is_null($is_exist)) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) < \Carbon\Carbon::now()) {
                $status_code = 400;
                $message = "OTP Expired";
            } else {
                Otp::where('phone_number', $phone_number)->update([
                    'is_used' => true
                ]);
            }
        } else {
            $status_code = 400;
            $message = "Invalid OTP";
        }

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'data' => $request->all()
        ];
    }

    public function appCheckOtp(Request $request)
    {
        $access_token = "";
        $status_code = 200;
        $message = "Valid OTP";
        $datas = "";

        // return $request->all();
        $is_exist = Otp::where('phone_number', $request['phone_number'])->where('otp', $request['otp'])->first();
        if (!is_null($is_exist)) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) < \Carbon\Carbon::now()) {
                $status_code = 400;
                $message = "OTP Expired";
            } else {
                Otp::where('phone_number', $request['phone_number'])->update([
                    'is_used' => true
                ]);

                $customer_array = [
                    "customer_name" => $request['full_name'],
                    "customer_phone" => $request['phone_number'],
                    "customer_password" => Hash::make($request['password'])
                ];
                try {
                    Customer::firstOrCreate($customer_array);
                } catch (\Exception $exception) {
                    $message = $exception->getMessage();
                }

                $credentials = [
                    'customer_phone' => $request['phone_number'],
                    'password' => $request['password'],
                ];
                if (Auth::guard('is_customer')->attempt($credentials)) {
                    $datas = Auth::guard('is_customer')->user();
                    if (is_null($datas)) {
                        $status_code = 400;
                        $message = "User not found";
                        return getApiErrorResponse($status_code, $message, $request->all());
                    }
                    $access_token = $datas->createToken('QC')->accessToken;
                }

            }
        } else {
            $status_code = 400;
            $message = "Invalid OTP";
        }

        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'message' => $message,
            'access_token' => $access_token,
            'data' => $datas
        ];
    }


    public function androidRegistration(Request $request)
    {
        /*        if ($request['api_from'] == "android") {
                    $customer_array = [
                        "customer_name" => $request['data']['customer_email'],
                        "customer_phone" => $request['data']['customer_phone'],
                        "customer_password" => Hash::make($request['data']['customer_password'])
                    ];
                } else {
                    $customer_array = [
                        "customer_name" => $request['customer_name'],
                        "customer_phone" => $request['customer_phone'],
                        "customer_password" => Hash::make($request['customer_password'])
                    ];
                }*/
        $phone_number = $request['data']['customer_phone'];

        $status_code = 200;
        $message = "Success";

        $is_valid = validatePhoneNumber($phone_number);
        if ($is_valid == 0) {
            $message = "Invalid Phone Number";
            return getApiErrorResponse(400, $message, $request->all());
        }

        $is_account_exist = Customer::where('customer_phone', $phone_number)->first();
        if (!is_null($is_account_exist)) {
            $message = "Already have an account with this Phone Number";
            return getApiErrorResponse(400, $message, $request->all());

        }
        $otp = getOtp();

        $is_exist = Otp::where('phone_number', $phone_number)->where('is_used', false)->orderBy('created_at', 'DESC')->first();
        if (!is_null($is_exist)) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) >= \Carbon\Carbon::now()) {
                $message = "You have an active OTP";
                $status_code = 400;
                $otp = $is_exist->otp;
            } else {
                $status_code = 200;
                $message = "Check your inbox for OTP.";
                Otp::create([
                    'phone_number' => $phone_number,
                    'otp' => $otp,
                ]);
                $message = "Check your inbox for OTP.";
                $sms = "Your MartVenue verification code is " . $otp;
                sendSms($phone_number, $sms);
            }
        } else {
            $status_code = 200;
            $message = "Check your inbox for OTP.";

            $sms = "Your MartVenue verification code is " . $otp;
            sendSms($phone_number, $sms);
            Otp::create([
                'phone_number' => $phone_number,
                'otp' => $otp,
            ]);
        }
        $request['otp'] = $otp;//TODO://
        return $data = [
            'status_code' => $status_code,
            'custom_status_code' => $status_code,
            'timer' => getExpireLimit(),
            'message' => $message,
            'data' => $request->all()
        ];


    }


    public function androidCheckOtp(Request $request)
    {
        $access_token = "";
        $status_code = 200;
        $message = "Valid OTP";
        $datas = "";

        $phone_number = $request['data']['customer_phone'];
        $type = $request['type'];
        if ($type == "signup") {
            // return $request->all();
            $is_exist = Otp::where('phone_number', $phone_number)->where('otp', $request['otp'])->first();
            if (!is_null($is_exist)) {
                if (Carbon::parse($is_exist->created_at)
                        ->addSeconds(getExpireLimit()) < \Carbon\Carbon::now()) {
                    $status_code = 400;
                    $message = "OTP Expired";
                } else {
                    Otp::where('phone_number', $phone_number)->update([
                        'is_used' => true
                    ]);

                    $customer_array = [
                        "customer_name" => $request['data']['customer_name'],
                        "customer_email" => $request['data']['customer_email'],
                        "customer_phone" => $request['data']['customer_phone'],
                        "customer_password" => Hash::make($request['data']['customer_password'])
                    ];
                    try {
                        Customer::firstOrCreate($customer_array);
                    } catch (\Exception $exception) {
                        $message = $exception->getMessage();
                    }

                    $credentials = [
                        'customer_phone' => $request['data']['customer_phone'],
                        'password' => $request['data']['customer_password']
                    ];
                    if (Auth::guard('is_customer')->attempt($credentials)) {
                        $datas = Auth::guard('is_customer')->user();
                        if (is_null($datas)) {
                            $status_code = 400;
                            $message = "User not found";
                            return getApiErrorResponse($status_code, $message, $request->all());
                        }
                        $access_token = $datas->createToken('QC')->accessToken;
                    }

                }
            } else {
                $status_code = 400;
                $message = "Invalid OTP";
            }

            return $data = [
                'status_code' => $status_code,
                'custom_status_code' => $status_code,
                'message' => $message,
                'access_token' => $access_token,
                'data' => $datas
            ];
        } else {

            //Customer::update();
            //TODO::Reseyt Pass


        }

    }

    public function androidUpdateProfile(Request $request)
    {


        $customer_data = json_decode($request['json'], true);
        $customer_data = $customer_data['data'];

        if ($request->hasFile('user_image')) {

            $image = $request->file('user_image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(250, 250);
            $image_resize->save(public_path('/images/user/' . $image_name));
            $profile_pic = '/images/user/' . $image_name;

            $customer_array = [
                "customer_name" => $customer_data['customer_name'],
                "customer_email" => $customer_data['customer_email'],
                "image" => $profile_pic
            ];
        } else {
            $customer_array = [
                "customer_name" => $customer_data['customer_name'],
                "customer_email" => $customer_data['customer_email'],
            ];
        }

        //return $customer_array;
        try {
            Customer::where('customer_id', $customer_data['customer_id'])->update($customer_array);

            return $data = [
                'status_code' => 200,
                'custom_status_code' => 200,
                'message' => "Successfully Updated",
                'access_token' => "",
                'data' => Customer::where('customer_id', $customer_data['customer_id'])->first()
            ];


        } catch (\Exception $exception) {


            return $data = [
                'status_code' => 400,
                'custom_status_code' => 400,
                'message' => $exception->getMessage(),
                'data' => $request->all()
            ];
        }


    }

    public function resetPass(Request $request)
    {


        if ($request['api_from'] == "android") {
            $phone_number = $request['data']['customer_phone'];
            $customer_array = [
                "customer_password" => Hash::make($request['data']['customer_password']),
            ];
        } else {
            $phone_number = $request['phone_number'];
            $customer_array = [
                "customer_password" => Hash::make($request['customer_password']),
            ];
        }

        //return $customer_array;
        try {
            Customer::where('customer_phone', $phone_number)->update($customer_array);

        } catch (\Exception $exception) {
        }
        return $data = [
            'status_code' => 200,
            'custom_status_code' => 200,
            'message' => "Successfully Updated",
            'access_token' => "",
            'data' => $request->all()
        ];


    }

}
