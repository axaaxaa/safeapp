<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Flc\Alidayu\Client;
use Flc\Alidayu\App;
use Flc\Alidayu\Requests\AlibabaAliqinFcSmsNumSend;
use Config;
use Illuminate\Support\Facades\Redis;
use App\Store\UserStore;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    private static $userStore;
    public function __construct(UserStore $userStore)
    {
        self::$userStore = $userStore;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

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
        $data = $request->all();

        //1.数据过滤
        if(empty($data['user_info'])) return back();

        //2.判断用户是否已存在
        $result = self::$userStore->findUser($data);

        if (!empty($result)){
            return view('user.login', ['status' => '101', 'msg' => '您已注册，请登录']);
        }

        $code = Redis::get('TEL:'.$data['tel']);
        if($code != $data['code']){
            return back();
        }
        $uuid = Uuid::uuid1()->getHex();
        $create = [
            'guid' => $uuid,
            'phone' => $data['tel']
        ];
        $userInfo = self::$userStore->create($create);
        if(empty($userInfo)){
            return back();
        }else{
            return redirect($data['path']);
        }
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

    /*
     * 发送阿里大于验证码
     */
    public function sendcode(Request $request){

        $config = [
            'app_key'    => Config::get('alisms.app_key'),
            'app_secret' => Config::get('alisms.app_secret'),
        ];
        $data = $request->all();
        $tel = $data['phone'];
        $code = rand(100000, 999999);
        Redis::setex('TEL:'.$tel,180,$code);
        // 数据过滤
        if(empty($data['phone']))   return false;

        $client = new Client(new App($config));
        $req    = new AlibabaAliqinFcSmsNumSend;

        $req->setRecNum($tel)
            ->setSmsParam([
                'code' => $code
            ])
            ->setSmsFreeSignName('孙健魁')
            ->setSmsTemplateCode('SMS_27590030');

        $result = $client->execute($req);

        return response()->json(['smsResult'=>$result]);

    }
}
