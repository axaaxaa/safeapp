<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
    //
    public function send()
    {
        $name = '学院君';
        $flag = Mail::send('emails.test',['name'=>$name],function($message){
            $to = '929407250@qq.com';
            $message ->to($to)->subject('测试邮件');
        });

        if($flag){
            echo '发送邮件成功，请查收！';
        }else{
            echo '发送邮件失败，请重试！';
        }
    }
}
