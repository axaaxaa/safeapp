<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store\UserStore;
use Ramsey\Uuid\Uuid;
use App\Store\AdminStore;
use Illuminate\Support\Facades\Redis;
class RegisterController extends Controller
{

    private static $adminStore;
    private static $userStore;
    public function __construct(AdminStore $adminStore, UserStore $userStore)
    {
        self::$adminStore = $adminStore;
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
        return view('user.register');
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
//        dd($result);
        if (!empty($result)){
            return view('user.login', ['status' => '101', 'msg' => '您已注册，请登录']);
        }

        $code = Redis::get('TEL:'.$data['user_info']);
        if($code != $data['code']){
            return back();
        }
        $uuid = Uuid::uuid1()->getHex();
        $password = md5($data['password'].'limingxia');
        $create = [
            'guid' => $uuid,
            'phone' => $data['user_info'],
            'password' => $password,
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
}
