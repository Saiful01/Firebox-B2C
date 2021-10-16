<?php

namespace App\Http\Controllers;

use App\AppSetting;
use App\Brand;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function appSetting(){
        $results = AppSetting::all();
        return view('admin.app_setting.app')->with('results', $results);
    }

    public function update(Request $request)
    {
//        return $request->all();
        try {
            AppSetting::where('id', 1)->update( $request->except(['_token']));
            return back()->with('success', "Successfully Updated");

        } catch (Exception $exception) {
            return back()->with('failed', $exception->getMessage());
        }
    }


}
