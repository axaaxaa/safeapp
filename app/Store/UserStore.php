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
use Illuminate\Support\Facades\Redis;

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
        //3.判断用户以那种方式登录，a.手机号 b.邮箱 c.用户名
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
        if (empty($result))
            return ['status' => '404', 'msg' => '登录失败，用户名与密码不匹配'];
        Session::set('user', $result);
        return ['status' => '200', 'msg' => ''];
    }

    public function findUser($data){
        //1. 数据过滤
        if (empty($data) || empty($data['user_info']))
            return false;
        $where = [
            'username' => $data['user_info']
        ];
        if (preg_match("/^(1(([35][0-9])|(47)|[8][0126789]))\d{8}$/", $data['user_info'])){
            $where = [
                'phone' => $data['user_info']
            ];
        }
        if (preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i",$data['user_info'])){
            $where = [
                'email' => $data['user_info']
            ];
        }
        $result = self::$userModel->findUser($where);
        return $result;
    }

    public function findByGuid($guid){

        //1.数据验证
        if(empty($guid)) return false;

        //2.查询hash
        $redisOne= Redis::HGetAll($this->hashKey.$guid);

        //3.查询数据库
        if(empty($redisOne)){
            $modelOne = self::$userModel->findByGuid($guid);

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
        $result = self::$userModel->create($create);

        if(empty($result)) return false;

        //3. 添加缓存
        Redis::Lpush($this->indexCourseId,$create['guid']);
        $redisOne = $this->findByGuid($create['guid']);

        return $redisOne;
    }

    /*
     * 查询所有用户
     */
    public function findAll(){

        //2. 查询list
        $RedisCourseAll = Redis::LRange($this->indexCourseId, 0, -1);

        if (empty($RedisCourseAll)){

            $modelCourseAll = self::$userModel->getOfAll();
            if(empty($modelCourseAll)) return false;

            $RedisCourseAll = [];
            foreach ($modelCourseAll as $course){
                Redis::Lpush($this->indexCourseId, $course->guid);

                $RedisCourseAll[] = $course->guid;
            }

        }

        $courseAll = [];

        foreach ($RedisCourseAll as $one) {
//            $courseAll = $this->findByGuid($one);
            array_push($courseAll, $this->findByGuid($one));
        }
        return $courseAll;
    }

    public function findAllUser(){
        $modelCourseAll = self::$userModel->getOfAll();
        return $modelCourseAll;
    }

}