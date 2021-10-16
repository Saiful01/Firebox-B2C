<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Otp;
use App\Shop;
use App\ShopOperator;
use App\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic as Image;
use function GuzzleHttp\Promise\all;

class MerchantController extends Controller
{

    public function registration()
    {

        return view('merchant.registration.login');
    }

    public function registrationShop($id)
    {
        //return $id;

        return view('merchant.registration.shop');
    }


    public function RegistrationStore(Request $request)
    {

        //return $request->all();
        $status = true;
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            /*  'nid' => 'required',*/
            'password' => 'required',
            'shop_name' => 'required',
            'shop_address' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            /*   'dob' => 'required',
               'shop_phone' => 'required',*/

        ]);
        if ($request['confirm_password'] != $request['password']) {
            return back()->with('failed', "Password And Confirm Password Not Matched");
        }

        //Check phoen number is exist

        unset($request['confirm_password']);


        if ($request->hasFile('image')) {
            /*  $this->validate($request, [
                  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
              ]);*/
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/shop');
            $image->move($destinationPath, $image_name);
            $request->request->add(['trade_licence' => '/images/shop/' . $image_name]);

        }

        $shop = [
            'shop_name' => $request->shop_name,
            'shop_phone' => $request->shop_phone,
            'shop_address' => $request->shop_address,
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'trade_licence' => $request->trade_licence,
        ];

        $status = true;
        try {
            $shops_id = Shop::insertGetId($shop);

        } catch (\Exception $exception) {
            $status = false;
        }


        $request['password'] = Hash::make($request['password']);
        $user = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request['password'],
            'nid' => $request->nid,
            'dob' => $request->dob
        ];

        $is_exist = User::where('phone', $request->phone)->first();
        if (!is_null($is_exist)) {
            return back()->with('failed', "Merchant registration  failed. Already Registered");
        }


        try {
            $users_id = User::insertGetId($user);


        } catch (\Exception $exception) {
            $status = false;
        }

        $array = [
            'shop_id' => $shops_id,
            'user_id' => $users_id,
            'user_type' => 1
        ];
        try {
            ShopOperator::insert($array);

        } catch (\Exception $exception) {
            $status = false;
            return ($exception->getMessage());
        }


        if ($status == true) {
            return back()->with('success', "Merchant registration  successfully. MartVenue team will be contact with you soon");
        } else {
            return back()->with('failed', "Merchant registration  failed. Please Try Again");
        }
    }


    public function RegistrationShopStore(Request $request)
    {
        $request->validate([
            'shop_name' => 'required',
            'shop_phone' => 'required|numeric',
            'shop_email' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'upazila_id' => 'required',
            'shop_address' => 'required',
            'trade_licence' => 'required',

        ]);


        try {
            $shop = [
                'shop_name' => $request['shop_name'],
                'shop_details' => $request['shop_details'],
                'shop_phone' => $request['shop_phone'],
                'shop_email' => $request['shop_email'],
                'division_id' => $request['division_id'],
                'district_id' => $request['district_id'],
                'upazila_id' => $request['upazila_id'],
                'shop_address' => $request['shop_address'],
                'trade_licence' => $request['trade_licence'],
                'shop_image' => $request['shop_image'],
                'user_id' => $request['user_id'],

            ];
            $shop_id = Shop::create($shop);

            ShopOperator::create([
                'shop_id' => $shop_id,
                'user_id' => $request['user_id'],
                'user_type' => 1
            ]);

            return back()->with('success', "Profile Updated");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function login()
    {

        return view('merchant.registration.login');
    }

    public function forgetPassword()
    {

        return view('merchant.forgot_password.password_recovery');
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
        if ($request['confirm_password'] != $request['new_password']) {
            return back()->with('failed', "Password And Confirm Password Not Matched");
        }

        //Check phoen number is exist

        unset($request['confirm_password']);

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

            return \redirect()->to("/merchant/registration")->with('success', $message);
            //return back()->with('success', $message);

        } catch (Exception $exception) {
            $message = $exception->getMessage();
            $status_code = 400;

            return back()->with('failed', $message);
        }

    }

    public function dashboard()
    {

        return view('merchant.dashboard.index');
    }

    public function profile()
    {
        return view('merchant.profile.edit')
            ->with('result', Auth::user())
            ->with('shop', Shop::where('shop_id', Session::get('shop_id'))->first());
    }

    public function update(Request $request)
    {
        $id = $request['id'];
        unset($request['id']); //Remove id


        if ($request['password'] == null) {
            unset($request['password']);
        } else {
            $request['password'] = Hash::make($request['password']);
        }

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(100, 100);
            $image_resize->save(public_path('/images/user/' . $image_name));
            $request->request->add(['profile_pic' => '/images/user/' . $image_name]);

        }

        try {
            User::where('id', $id)->update($request->except(['image', '_token']));
            return back()->with('success', "Profile Updated");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function ShopUpdate(Request $request)
    {

        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image_resize = Image::make($image->getRealPath());
            $image_resize->resize(100, 100);
            $image_resize->save(public_path('/images/shop/' . $image_name));
            $request->request->add(['shop_image' => '/images/shop/' . $image_name]);

        }
        if ($request->hasFile('licence')) {
            $image = $request->file('licence');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/shop');
            $image->move($destinationPath, $image_name);
            $request->request->add(['trade_licence' => '/images/shop/' . $image_name]);

        }
        try {
            Shop::where('shop_id', $request['shop_id'])->update($request->except(['image', '_token', 'commission_rate']));
            return back()->with('success', "Shop Updated");
        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
