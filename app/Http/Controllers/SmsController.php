<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SmsController extends Controller
{
    public function home(){

        $data = DB::table("sms_send")->where('user_id',Auth::id())->get();

        foreach ($data as $index => $datum) {
            $data[$index]->receiversCount = 0;
            $data[$index]->sendCound = 0;
        }
        return view("sms.home",compact('data'));
    }
    public function sendHome()
    {
        $remainder = getCredit();
        return view("sms.send", compact('remainder'));
    }

    public function send(Request $request)
    {
        $json_data['state'] = true;

        $niceNames = array(
            'file' => 'Dosya',
        );

        $messages = [

        ];

        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'from' => 'required',
            'sms_send_receivers' => 'required',
        ], $messages, $niceNames)->validate();


        $use = $this->creditValidate($request->message,$request->sms_send_receivers);


        if (intval(getCredit()) <= intval($use['usedCredit'] )){
            $json_data['state']  = false;
            $json_data['message']  = "Krediniz Bulunmuyor veya yetersiz!";
            return json_encode($json_data);
        }

        if ($request->scheduleDateCheck == 1) {
            $request->merge(['scheduleDate' => null]);
        } else {
            $request->merge(['scheduleDate' => $request->scheduleDate]);
        }

        $sms_send_receivers = explode("\n", str_replace("\r", "", $request->sms_send_receivers));


        $request->merge(['created_at' => date("Y-m-d H:i:s")]);
        $request->merge(['user_id' => Auth::id()]);
        //dd($request->all());
        DB::table("sms_send")->insert($request->except("_token","sms_send_receivers","scheduleDateCheck"));
        $sms_id = DB::getPdo()->lastInsertId();

        foreach ($sms_send_receivers as $index => $sms_send_receiver) {
            $receivers = [
                'user_id' => Auth::id(),
                'sms_id' => $sms_id,
                'number' => $sms_send_receiver,
            ];
            DB::table("sms_send_receivers")->insert($receivers);
        }


        return json_encode($json_data);


    }

    public function validateHome()
    {
        return view("sms.validate");
    }

    public function creditValidatePost(Request $request)
    {
        $json = $this->creditValidate($request->message,$request->sms_send_receivers);
        return json_encode($json);
    }


    public function creditValidate($message,$sms_send_receivers){

        $character = trim(strlen($message));
        $smsAdet = ceil($character / 155);
        // $smsAdet =  $character / 155;


        $lines = preg_split('/\n/', $sms_send_receivers);
        $Total_lines = (empty(trim($sms_send_receivers))) ? 0 : count($lines);


        $credit_settings = DB::table("credit_settings")->first();


        $json['smsCount'] = $smsAdet;
        $json['totalLines'] = $Total_lines;
        $json['usedCredit'] = ($smsAdet * $Total_lines) * $credit_settings->sms_send;
        $json['character'] = $character;
        return $json;
    }



}
