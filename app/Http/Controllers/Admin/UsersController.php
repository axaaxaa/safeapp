<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Store\AdminStore;
use App\Store\UserStore;
use Ramsey\Uuid\Uuid;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private static $adminStore;
    private static $userStore;
    public function __construct(AdminStore $adminStore, UserStore $userStore)
    {
        self::$adminStore = $adminStore;
        self::$userStore = $userStore;
    }


    public function index()
    {
        //
        $users = self::$userStore->findAllUser();
        return view('admin.user.index',['userList' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $create = [
            'guid' => Uuid::uuid1()->getHex(),
            'username' => $data['username'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => md5($data['email'].'limingxia')
        ];
        $result = self::$userStore->createByAdmin($create);
        if(empty($result)){
            return back();
        }
        return redirect('/user');
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
        $users = self::$userStore->findAllUser();
        $userInfo = self::$userStore->findByGuid($id);
        return view('admin.user.edit',['userInfo'=>$userInfo,'classList' => $users]);
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
        $this->validate($request, [
            'username' => 'required',
            'phone' => 'required | max:11 | min:11',
            'email' => 'required'
        ]);

        $data = $request->all();
        $update = [
            'username' => $data['username'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ];
        $result = self::$userStore->update($update, $id);
        if (empty($result)){
            return back();
        }
        return redirect('/user');
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
