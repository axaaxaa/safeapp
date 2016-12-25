<?php

/**
 * Created by PhpStorm.
 * User: limingxia
 * Date: 2016/12/25
 * Time: 11:18
 */

namespace App\Store;
use App\Model\UserModel;
use Illuminate\Support\Facades\Session;

class UserStore
{
    public $indexCourseId = 'LIST:User:UserId';
    public $hashKey = 'HASH:User:';
    private static $userModel;
    public function __construct(UserModel $userModel)
    {
        self::$userModel = $userModel;
    }
    public function login($data){
        //1. 数据过滤
        if (empty($data) || empty($data['user_info']) || empty($data['password']))
            return false;
        $password = md5($data['password'].'limingxia');
        $where = [
            'username' => $data['user_info'],
            'password' => $password,
        ];

        //2.判断Redis是否存在用户//2.查询hash
//        $redisC= Redis::HGetAll($this->hashKey.$courseId);

        //3.判断用户以那种方式登录，a.手机号 b.邮箱 c.用户名
        $type = $data['user_info'];
        if (preg_match("/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/", $data['user_info'])){
            $where = [
                'phone' => $data['user_info'],
                'password' => $password,
                'password' => $password,
            ];
        }
        if (preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$data['user_info'])){
            $where = [
                'email' => $data['user_info'],
                'password' => $password,
            ];
        }
        $result = self::$userModel->findUser($where);
//        dd(self::$userModel->findByGuid($result->guid));
        if (empty($result))
            return ['status' => '404', 'msg' => '登录失败，用户名与密码不匹配'];
//                return view('',['msg' => '登录失败，手机号与密码不匹配']);
        Session::set('user', $result);
        return ['status' => '200', 'msg' => ''];
        dd($where);
        dd($data);
    }

    public function findByGuid($guid){

        //1.数据验证
        if(empty($guid)) return false;

        //2.查询hash
        $redisOne= Redis::HGetAll($this->hashKey.$guid);

        //3.查询数据库
        if(empty($redisOne)){
            $modelOne = $this->dataCourseModel->findByCourseId($guid);

            if(empty($modelOne)) return false;

            $modelOne = json_decode(json_encode($modelOne),true);

            Redis::hMSet($this->hashKey.$guid,$modelOne);

            return $modelOne;
        }

        return $redisOne;
    }
}