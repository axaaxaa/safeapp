@extends('admin.layouts.master')
@section('content')
    <div class="page-title">
        <h3 class="title"><font><font>添加分类</font></font></h3>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title"><font><font>添加分类</font></font></h3></div>
                <div class="panel-body">
                    <div class=" form p-20">
                        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="{{ url('/class') }}" novalidate="novalidate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2"><font><font>分类名称</font></font></label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="cname" name="name" type="text" required="" aria-required="true">
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

