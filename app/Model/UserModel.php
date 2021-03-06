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
        var_dump('3333');
        var_dump(DB::table('data_users')->where($where)->first());
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

    public function update($data,$guid){
        return DB::table('data_users')->where('guid',$guid)->update($data);
    }
}