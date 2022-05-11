<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

 function getCredit(){
    $credit = DB::table("credits")->selectRaw('SUM(amount) as C')->where('user_id', Auth::id())->first()->C;
    $used = DB::table("sms_send_receivers")->where('user_id', Auth::id())->count();
    $email = DB::table("email_send_receivers")->where('user_id', Auth::id())->count();
    $remainder = $credit - $used - $email;

    return $remainder;
}

// Simple SMS send function
function sendSMS($msisdn, $username, $password, $output) {
    $URL = 'http://smsc.txtnation.com:5002/checkHLR?';
    $URL .= http_build_query([
        'msisdn'    => $msisdn,
        'username'  => $username,
        'password'  => $password,
        'output'    => $output
    ]);
    $fp = fopen($URL, 'r');
    return fread($fp, 1024);
}

?>
