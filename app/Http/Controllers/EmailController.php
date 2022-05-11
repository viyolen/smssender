<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function home(){

        $data = DB::table("email_send")->where('user_id',Auth::id())->get();

        foreach ($data as $index => $datum) {
            $data[$index]->receiversCount = 0;
            $data[$index]->sendCound = 0;
        }
        return view("email.home",compact('data'));
    }
    public function sendHome()
    {
        $remainder = getCredit();

        $mail_templates = DB::table("mail_templates")->where('user_id', Auth::id())->get();
        $mail_groups = DB::table("mail_groups")->where('user_id', Auth::id())->get();
        return view("email.send", compact('mail_templates', 'mail_groups', 'remainder'));
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
            'subject' => 'required',
            'group_id' => 'required',
            'template_id' => 'required',
        ], $messages, $niceNames)->validate();

        $use = $this->creditValidate($request->message, $request->sms_send_receivers);


        if (intval(getCredit()) <= intval($use['usedCredit'])) {
            $json_data['state'] = false;
            $json_data['message'] = "Krediniz Bulunmuyor veya yetersiz!";
            return json_encode($json_data);
        }

        if ($request->scheduleDateCheck == 1) {
            $request->merge(['scheduleDate' => null]);
        } else {
            $request->merge(['scheduleDate' => $request->scheduleDate]);
        }

        $mail_groups_receivers = DB::table("mail_groups_receivers")->where('id',$request->group_id)->get();
        $template = DB::table("mail_templates")->where('id',$request->template_id)->first();



        $request->merge(['created_at' => date("Y-m-d H:i:s")]);
        $request->merge(['user_id' => Auth::id()]);
        $request->merge(['email_temp' => $template->html]);

        DB::table("email_send")->insert($request->except("_token","scheduleDateCheck","customRadio"));
        $send_id = DB::getPdo()->lastInsertId();

        foreach ($mail_groups_receivers as $index => $row) {
            $receivers = [
                'user_id' => Auth::id(),
                'email_send_id' => $send_id,
                'email' => $row->email,
            ];
            DB::table("email_send_receivers")->insert($receivers);
        }


        return json_encode($json_data);

    }

    public function validateHome()
    {
        return view("email.validate");
    }



    public function creditValidatePost(Request $request)
    {
        $json = $this->creditValidate($request->group);
        return json_encode($json);
    }

    public function creditValidate($id)
    {
        $credit_settings = DB::table("credit_settings")->first();
        $adet = DB::table("mail_groups_receivers")->where('user_id', Auth::id())->where('id', $id)->count();
        $json['totalLines'] = $adet;
        $json['usedCredit'] = $adet * $credit_settings->email_send;
        return $json;
    }

}
