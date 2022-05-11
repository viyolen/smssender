<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login()
    {
        if (!Auth::check()) {

            return view("login");
        } else {
            return redirect(route("index"));
        }
    }

    public function loginPost(Request $request)
    {
        $json['state'] = false;

        $messages = [

        ];

        $niceNames = array(
            "password" => "Şifre",
        );

        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ], $messages, $niceNames)->validate();

        if (isset($request->beni_hatirla)) {
            $remember = true;
        } else {
            $remember = false;
        }


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $json['state'] = true;
        } else {
            $json['state'] = false;
        }
        return json_encode($json);

    }


    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    public function sifremiUnuttumPost(Request $request)
    {

        $json['state'] = true;


        $messages = [

        ];
        $niceNames = array(
            "co_code" => "Şirket Kodu",
            'g-recaptcha-response' => 'Robot Olmadığını Doğrula',
            "username" => "Kullanıcı Adı"
        );

        $validator = Validator::make($request->all(), [
            'co_code' => 'required',
            'username' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ], $messages, $niceNames)->validate();

        $get = DB::table("admin_users")->where("co_code", $request->co_code)->where('username', $request->username)->first();


        if (isset($get->Id)) {
            if ($get->co_code != 6312) {

                $password = rand(44444, 99999);
                $passwordHash = Hash::make($password);

                DB::table($this->name)->where('Id', $get->Id)->update([
                    "pass_reset" => 1,
                    "password" => $passwordHash
                ]);
                netgsm_sms($get->phone, "Sayın " . $get->name . " " . $get->surname . " şifreniz sıfırlanmıştır. Kullanıcı Adınız: " . $get->username . " Şifre: " . $password);

            }
        }
        return json_encode($json);
    }

    public function profile()
    {
        return view("profile");
    }

    public function profilePost(Request $request)
    {

        $json['state'] = false;
        $messages = [

        ];

        $niceNames = array(
            "password" => "Şifre",
        );

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ], $messages, $niceNames)->validate();


        $status = DB::table("users")->where("id", Auth::user()->id)->update($request->except('_token'));
        if ($status)
            $json['state'] = true;

        return json_encode($json);
    }

    public function profilePasswordPost(Request $request)
    {
        $json['state'] = true;
        $messages = [
            'password_ex.required' => 'Şifre Belirlemelisiniz',
            'password_ex.same' => 'Şifre tekrarı eşleşmiyor.',
            'password_ex.min' => 'Şifre en az 6 karakter olmalıdır',
            'password_ex.regex' => 'Şifre Büyük, Küçük Harf, özel karakter ve Rakam olmalıdır ',
            'password_ex.required_with' => 'Şifre Değiştirmek için bütün alanları doldurun'
        ];

        $niceNames = array(
            'username' => 'Yetkili Email',
            'default_password' => 'Mevcut Şifre',
            'password_confirmation' => 'Şifre Tekrar',
            'password_ex' => 'Şifre'
        );

        $validator = Validator::make($request->all(), [
            'default_password' => 'required',
            'password_confirmation' => 'required',
            'password_ex' => 'required|same:password_confirmation|required_with:password_confirmation|required_with:default_password|min:6|different:default_password'
        ], $messages, $niceNames)->validate();


        if (Hash::check($request->default_password, Auth::user()->password)) {

            $update['password'] = Hash::make($request->password_ex);
        } else {
            $json['state'] = false;
            $json['message'] = "Mevcut Şifreniz Yanlış";
            return json_encode($json);
        }



        $status = DB::table("users")->where("id", Auth::user()->id)->update($update);


        Auth::logout();
        return json_encode($json);
    }
}
