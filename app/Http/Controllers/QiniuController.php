<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use Qiniu\Processing\PersistentFop;


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
        return view('qiniu');
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
        //上传图片
        $file = $request->file('file');

        // 需要填写你的 Access Key 和 Secret Key
        $accessKey = env('QINIU_ACCESSKEY');
        $secretKey = env('QINIU_SECRETKEY');

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        // 要上传的空间
        $bucket = env('QINIU_BUCKET');

        // 生成上传 Token
        $token = $auth->uploadToken($bucket);

        // 要上传文件的本地路径
        $filePath = $file->getRealPath();

        // 上传到七牛后保存的文件名
        $key = 'safeapp/'.time().'.'.$file->getClientOriginalExtension();

        // 初始化 UploadManager 对象并进行文件的上传。
        $uploadMgr = new UploadManager();

        // 调用 UploadManager 的 putFile 方法进行文件的上传。
        list($ret, $err) = $uploadMgr->putFile($token, $key, $filePath);
        echo "\n====> putFile result: \n";
        if ($err !== null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }

        /*// 需要填写你的 Access Key 和 Secret Key
        $accessKey = env('QINIU_ACCESSKEY');
        $secretKey = env('QINIU_SECRETKEY');

        // 构建鉴权对象
        $auth = new Auth($accessKey, $secretKey);

        // 要上传的空间
        $bucket = env('QINIU_BUCKET');
        $token = $auth->uploadToken($bucket);
        $uploadMgr = new UploadManager();
        // 上传到七牛后保存的文件名
        $file = $request->file('file');
//        $key = 'safeapp/'.time().'.'.$file->getClientOriginalExtension();
        $key = 'test3333.mp4';
        $wmImg = \Qiniu\base64_urlSafeEncode('http://ogjfxbd4v.bkt.clouddn.com/logo.png');
        $pfop = "avthumb/m3u8/wmImage/$wmImg";

//转码完成后回调到业务服务器。（公网可以访问，并相应200 OK）
        $notifyUrl = 'https://www.aaaxia.com';

//独立的转码队列：https://portal.qiniu.com/mps/pipeline
        $pipeline = 'mpstest';

        $policy = array(
            'persistentOps' => $pfop,
            'persistentNotifyUrl' => $notifyUrl,
            'persistentPipeline' => $pipeline
        );
        $token = $auth->uploadToken($bucket, null, 3600, $policy);

        list($ret, $err) = $uploadMgr->putFile($token, null, $key);
        echo "\n====> putFile result: \n";
        if ($err !== null) {
            var_dump($err);
        } else {
            var_dump($ret);
        }*/
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
            'persistentNotifyUrl' => 'http://ok40rdqv9.bkt.clouddn.com',
        );
        $upToken = $auth->uploadToken($bucket, null, 3600, $policy);
//        $upToken = $auth->uploadToken($bucket);
        echo json_encode(array('uptoken' => $upToken));
    }
}
