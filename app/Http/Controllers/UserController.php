<?php

namespace App\Http\Controllers;

use App\Shop;
use App\ShopOperator;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function create()
    {
        return view('admin.user.create');
    }
    public function merchantCreate()
    {
        return view('merchant.user.create');
    }


    public function store(Request $request)
    {
        //return $request->all();


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/users');
            $image->move($destinationPath, $image_name);

            $request['profile_pic'] =  "/images/users/".$image_name;
        }


        $request['password'] = Hash::make($request['password']);
        $request['phone'] = $request['phone'];
        unset($request['_token']);
        unset($request['image']);


        //return $request->all();
        try {
            if(Auth::user()->user_type==1){
           // $request['password']= Hash::make($request['password']);

            DB::table('users')->insert($request->except(['image']));
            return back()->with('success', "Successfully Created");
            }
            elseif ($request['user_type']==0) {
                DB::table('users')->insert($request->except(['image']));
                return back()->with('success', "Successfully Created");

            }
            else{
                $shopUser = [
                    'name'=>$request['name'],
                    'phone'=>$request['phone'],
                    'email'=>$request['email'],
                    'user_type'=>2,
                    'password'=>$request['password'],
                    'profile_pic'=>$request['profile_pic'],

                ];

              $user_id= User::insertGetId($shopUser);
              $shopOperator=[
                'shop_id'=>Session::get('shop_id'),
                'user_id'=>$user_id,
                'user_type'=>2,
            ];
             ShopOperator::create($shopOperator);
             return back()->with('success', "Successfully Created");
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }
    }
    public function merchantStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required|numeric',
            'email' => 'required',
            'nid' => 'required',
            'dob' => 'required',
            'password' => 'required',
            'user_type' => 'required',
        ]);
        $is_exist= User::where('phone', $request['phone'])->first();
         if ($is_exist!= null)
             return back()->with('failed', "This Phone Number User Already Exist");



        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/users');
            $image->move($destinationPath, $image_name);

            $request['profile_pic'] =  "/images/users/".$image_name;
        }


        $request['password'] = Hash::make($request['password']);
        $request['phone'] = $request['phone'];

        //return $request->all();
        try {
           /*     $shopUser = [
                    'name'=>$request['name'],
                    'phone'=>$request['phone'],
                    'email'=>$request['email'],
                    'user_type'=>$request['user_type'],
                    'password'=>$request['password'],
                    'profile_pic'=>$request['profile_pic'],

                ];*/

              $user_id= User::insertGetId($request->except('image', '_token'));
              $shopOperator=[
                'shop_id'=>Session::get('shop_id'),
                'user_id'=>$user_id,
                'user_type'=>2,
            ];
             ShopOperator::create($shopOperator);
             return redirect('merchant/user/show')->with('success', "Successfully Created");

        } catch (Exception $exception) {
            return $exception->getMessage();
            return back()->with('failed', $exception->getMessage());
        }
    }

    public function show(User $coupon)
    {
      //return User::get();
        if(Auth::user()->user_type==1){
         $results = User::orderBy('created_at', 'DESC')->get();
        return view('admin.user.show')->with('results', $results);
        }
       else{
           $results = ShopOperator::join('users','shop_operators.user_id','=','users.id')
          ->leftJoin('shops','shop_operators.shop_id','=','shops.shop_id')
        ->where('shop_operators.shop_id', Session::get("shop_id") )
          ->get();
        return view('admin.user.show')->with('results', $results);
        }


    }
    public function merchantShow(User $coupon)
    {
           $results = ShopOperator::join('users','shop_operators.user_id','=','users.id')
          ->leftJoin('shops','shop_operators.shop_id','=','shops.shop_id')
          ->where('shop_operators.shop_id', Session::get("shop_id") )
          ->get();
        return view('merchant.user.show')->with('results', $results);
    }


    public function edit($id)
    {
        $result = User::where('id', $id)->first();
        return view('admin.user.edit')
            ->with('result', $result);
    }
    public function merchantEdit($id)
    {
        $result = User::where('id', $id)->first();
        return view('merchant.user.edit')
            ->with('result', $result);
    }

    public function update(Request $request)
    {

        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/users');
                $image->move($destinationPath, $image_name);

                $request['profile_pic'] =  "/images/users/".$image_name;
            }

            if ($request['password'] != null) {
                $request['password'] = Hash::make($request['password']);
            }else{
                unset($request['password']);
            }



            User::where('id', $request['id'])->update($request->except(['id', 'image', '_token']));
            return back()->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
    public function merchantUpdate(Request $request)
    {

        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/images/users');
                $image->move($destinationPath, $image_name);

                $request['profile_pic'] =  "/images/users/".$image_name;
            }

            if ($request['password'] != null) {
                $request['password'] = Hash::make($request['password']);
            }else{
                unset($request['password']);
            }


            User::where('id', $request['id'])->update($request->except(['id', 'image', '_token']));
            return redirect('merchant/user/show')->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


    public function destroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
    public function merchantDestroy($id)
    {
        try {
            User::where('id', $id)->delete();
            return back()->with('success', "Successfully Deleted");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }
}
