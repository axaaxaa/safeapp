<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Qiniu\Auth;

class QiniuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('home/qiniu');
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

    public function upTokenUrl1(){
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
        $upToken = $auth->uploadToken($bucket, null, 3600, $policy);
//        $upToken = $auth->uploadToken($bucket);
        echo json_encode(array('uptoken' => $upToken));
    }
}
