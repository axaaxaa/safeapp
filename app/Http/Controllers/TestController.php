<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Nette\Mail\Message;
use Nette\Mail\SendmailMailer;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Redis::lrange("LIST:User:UserId",0,-1);
        dd($data);
        //
        /*$mail = new Message;
        $mail->setFrom('Michelle <lilian1131@163.com>')
            ->addTo('axaaxaa@163.com')
            ->addTo('929407250@qq.com')
            ->setSubject('Order Confirmation')
            ->setBody("Hello, Your order has been accepted.");
        $mailer = new SendmailMailer;
        $result = $mailer->send($mail);
        dd($result);*/
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
}
