<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OSS;

class AliossController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('alioss');
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
        $pic = $request->file('ossfile');
        // 判断图片有效性
        if (!$pic->isValid()) {
            return back()->withErrors('上传图片无效..');
        }
//        dd($pic);
        // 制作文件名
        $key = 'safeapp/'.time().'.'.$pic->getClientOriginalExtension();
        // 获取图片在临时文件中的地址
        $pic = $pic->getRealPath();
        //阿里 OSS 图片上传
        $result = OSS::upload($key, $pic);
        if ($result) {
            // success
            echo "文件上传成功";
        } else {
            // fail
            echo "文件上传失败";
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
