<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index(){
        $data = DB::table("users")->get();

        return view("users",compact('data'));
    }
    public function insert(Request $request){
        $json_data['state'] = false;


        $niceNames = array(
            'file' => 'Dosya',
        );

        $messages = [

        ];

        $validator = Validator::make($request->all(), [
            'password' => 'required',
            'email' => ['required', Rule::unique('users')],
        ], $messages, $niceNames)->validate();





        $request->merge(['password'=>Hash::make($request->password)]);

        $insert = DB::table("users")->insert($request->except('_token'));

        if ($insert)
            $json_data['state'] = true;


        return json_encode($json_data);
    }
    public function delete($id){
        $json_data['state'] = false;


        if (Auth::id() == $id)
            return redirect(route("userManagement."));



        $insert = DB::table("users")->where('id',$id)->delete();

        if ($insert)
            $json_data['state'] = true;




        return redirect(route("userManagement."));
    }
}
