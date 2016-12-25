<?php

/**
 * Created by PhpStorm.
 * User: limingxia
 * Date: 2016/12/25
 * Time: 11:18
 */

namespace App\Store;

use App\Model\AdminModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;

class AdminStore
{
    public $indexCourseId = 'LIST:Admin:AdminId';
    public $hashKey = 'HASH:Admin:';
    private static $adminModel;
    public function __construct(AdminModel $adminModel)
    {
        self::$adminModel = $adminModel;
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

        $result = self::$adminModel->findUser($where);
        if (empty($result))
            return ['status' => '404', 'msg' => '登录失败，用户名与密码不匹配'];
        Session::set('admin', $result);
        return ['status' => '200', 'msg' => ''];
    }

    public function findUser($data){
        //1. 数据过滤
        if (empty($data) || empty($data['user_info']))
            return false;
        $where = [
            'username' => $data['user_info']
        ];

        $result = self::$adminModel->findUser($where);
        return $result;
    }

    public function findByGuid($guid){

        //1.数据验证
        if(empty($guid)) return false;

        //2.查询hash
        $redisOne= Redis::HGetAll($this->hashKey.$guid);

        //3.查询数据库
        if(empty($redisOne)){
            $modelOne = self::$adminModel->findByGuid($guid);

            if(empty($modelOne)) return false;

            $modelOne = json_decode(json_encode($modelOne),true);

            Redis::hMSet($this->hashKey.$guid,$modelOne);

            return $modelOne;
        }

        return $redisOne;
    }

    public function create($create){
        //1. 数据验证
        if(empty($create) || empty($create['guid']) ||empty($create['phone'])){
            dd($create);
            return false;
        }

        //2. 插入数据库
        $result = self::$adminModel->create($create);

        if(empty($result)) return false;

        //3. 添加缓存
        Redis::Lpush($this->indexCourseId,$create['guid']);
        $redisOne = $this->findByGuid($create['guid']);

        return $redisOne;
    }
}