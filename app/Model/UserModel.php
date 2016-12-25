<?php

/**
 * Created by PhpStorm.
 * User: limingxia
 * Date: 2016/12/25
 * Time: 11:19
 */

namespace App\Model;
use DB;

class UserModel
{
    public function findUser($where){
        return DB::table('data_users')->where($where)->first();
    }

    public function findByGuid($guid){
        return DB::table('data_users')->where('guid',$guid)->first();
    }

    public function create($create){
        return DB::table('data_users')->insertGetId($create);
    }

    public function getOfAll(){
        return DB::table('data_users')->get();
    }
}