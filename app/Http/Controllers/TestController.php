<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Qiniu\Auth;

use Nette\Mail\SmtpMailer as SmtpMailer;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //creating an e-mail
        $mail = new Message;
        $mail->setFrom('limingxia <lilian@1131.com>')
            ->addTo('axaaxaa@163.com')
            ->addTo('929407250@qq.com')
            ->setSubject('Order Confirmation')
            ->setBody("Hello, Your order has been accepted.");
        //sending
      /*  $mailer = new SendmailMailer;
        $mailer->send($mail);*/

        $mailer = new SmtpMailer([
            'host' => 'smtp.163.com',
            'username' => 'lilian1131@163.com',
            'password' => 'liming07250',
            'secure' => 'ssl',
            'context' =>  [
                'ssl' => [
                    'capath' => '/path/to/my/trusted/ca/folder',
                ],
            ],
        ]);
        $mailer->send($mail);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function test()
    {
        $bucket = env('QINIU_BUCKET');
        $accessKey = env('QINIU_ACCESSKEY');
        $secretKey = env('QINIU_SECRETKEY');
        $auth = new Auth($accessKey, $secretKey); //鉴权

        $pfopOps = "*";
        $policy = array(
            //转换的格式
            'persistentOps' => $pfopOps,
            'persistentNotifyUrl' => 'https://www.aaaxia.com',
        );
        $upToken = $auth->uploadToken($bucket);
        dd($upToken);
    }
}
