@extends('admin.layouts.master')
@section('content')
    <div class="page-title">
        <h3 class="title"><font><font>用户列表</font></font></h3>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><font><font>响应表</font></font></h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th><font><font>用户名</font></font></th>
                                        <th><font><font>手机号</font></font></th>
                                        <th><font><font>邮箱</font></font></th>
                                        <th><font><font>操作</font></font></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($userList as $item)
                                    <tr>
                                        <td><font><font>{{ $item->username }}</font></font></td>
                                        <td><font><font>{{ $item->phone }}</font></font></td>
                                        <td><font><font>{{ $item->email }}</font></font></td>
                                        <td><font><font><a href="{{ url('/user') }}/{{$item->guid}}/edit">编辑</a></font></font></td>
                                    </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection