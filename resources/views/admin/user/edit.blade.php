@extends('admin.layouts.master')
@section('content')
    <div class="page-title">
        <h3 class="title"><font><font>编辑用户</font></font></h3>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>请重新填写修改用户信息</p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><font><font>编辑用户</font></font></h3></div>
                <div class="panel-body">
                    <div class=" form p-20">
                        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="{{ url('/user/'.$userInfo['guid']) }}" novalidate="novalidate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2"><font><font>用户名</font></font></label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="cname" name="username" type="text" value="{{ $userInfo['username'] }}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2"><font><font>手机号</font></font></label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="cemail" type="text" name="phone" value="{{ $userInfo['phone'] }}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2"><font><font>邮箱</font></font></label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="cemail" type="text" name="email" value="{{ $userInfo['email'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success" type="submit"><font><font>保存</font></font></button>
                                    <button class="btn btn-default" type="button"><font><font>取消</font></font></button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- .form -->
                </div> <!-- panel-body -->
            </div> <!-- panel -->
        </div> <!-- col -->

    </div>
    @endsection