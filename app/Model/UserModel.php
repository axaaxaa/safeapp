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

        $result = DB::table('data_users')->where('guid',$guid)->first();

        return $result;
    }
}