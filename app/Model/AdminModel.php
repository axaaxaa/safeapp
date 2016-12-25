<?php

/**
 * Created by PhpStorm.
 * User: limingxia
 * Date: 2016/12/25
 * Time: 11:19
 */

namespace App\Model;
use DB;

class AdminModel
{
    public function findUser($where){
        return DB::table('data_admin')->where($where)->first();
    }

    public function findByGuid($guid){
        return DB::table('data_admin')->where('guid',$guid)->first();
    }

    public function create($create){
        return DB::table('data_admin')->insertGetId($create);
    }
}