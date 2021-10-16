<?php

namespace App\Http\Controllers;

use App\Otp;
use App\Shop;
use App\ShopOperator;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{


    public function login()
    {
        //return 0;
        return view('admin.login.index');
    }

    public function loginCheck(Request $request)
    {
        // return $request->all();
        $user = User::where('phone', $request['phone'])->first();
        if (is_null($user)) {
            return back()->with('failed', 'This phone number is not registered, please Sign-up first');

        }


        $credentials = $request->only('phone', 'password');
        if (Auth::attempt($credentials)) {
            if (Auth::user()->user_type == 1 || Auth::user()->user_type == 0) {

                return redirect()->intended('/admin/dashboard');
                //Super admin

            } else if (Auth::user()->user_type == 2 || Auth::user()->user_type == 3) {
//return $request->all();
                //Shop Admin

                $shop = ShopOperator::where('user_id', Auth::user()->id)->first();
                Auth::user()->shop_id = $shop->shop_id;
                Auth::user()->is_admin = $shop->user_type;
                $request->session()->put('shop_id', $shop->shop_id);
                $request->session()->put('is_admin', $shop->user_type);

                $shop = Shop::where('shop_id', $shop->shop_id)->where('is_active', true)->first();
                if (is_null($shop)) {
                    Auth::logout();
                    return back()->with("failed", "Shop is Deactivated. Please try again later");
                }
                return redirect()->intended('/merchant/dashboard');


            } else {
                //Other
            }

        }

        return Redirect::to('/merchant/registration')
            ->with('failed', 'Email or password is wrong.')
            ->withInput();

    }

    public function resetPassword(Request $request)
    {

        //return $request->all();

        $validator = Validator::make($request->all(), [
            "phone" => 'required',
            "new_password" => 'required'
        ]);

        if ($validator->fails()) {
            return back()->with('failed', "Validation failed");
        }

        //OTP Verify
        $is_exist = Otp::where('phone_number', $request['phone'])->where('otp', $request['otp'])->first();
        if (!is_null($is_exist)) {
            if (Carbon::parse($is_exist->created_at)
                    ->addSeconds(getExpireLimit()) < \Carbon\Carbon::now()) {
                $status_code = 400;
                $message = "OTP Expired";
                return back()->with('failed', $message);
            }
        } else {
            $status_code = 400;
            $message = "Invalid OTP";
            return back()->with('failed', $message);
        }

        try {

            Otp::where('phone_number', $request['phone_number'])->update([
                'is_used' => true
            ]);

            $merchant_array = [
                "password" => Hash::make($request['new_password'])
            ];
            User::where('phone', $request['phone'])->update($merchant_array);

            $message = "Password changed Successfully, Login with your new password";
            $status_code = 200;
            $credentiatls = [
                'phone' => $request['phone'],
                'password' => Hash::make($request['new_password'])
            ];

            //Auth::guard('is_customer')->attempt($credentiatls);

            return \redirect()->to("/admin/login")->with('success', $message);
            //return back()->with('success', $message);

        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $status_code = 400;

            return back()->with('failed', $message);
        }

    }

    public function logout()
    {
        Auth::logout();
        return \redirect('/');
    }

}
