@extends('admin.layouts.master')
@section('content')
    <div class="page-title">
        <h3 class="title"><font><font>商品添加</font></font></h3>
    </div>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p>请重新填写修改商品信息</p>
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
                <div class="panel-heading"><h3 class="panel-title"><font><font>商品添加</font></font></h3></div>
                <div class="panel-body">
                    <div class=" form p-20">
                        <form class="cmxform form-horizontal tasi-form" id="commentForm" method="post" action="{{ url('/goods/'.$goodsInfo->guid) }}" autocomplate="true" novalidate="novalidate" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group ">
                                <label for="cname" class="control-label col-lg-2"><font><font>商品名称</font></font></label>
                                <div class="col-lg-10">
                                    <input class=" form-control" id="cname" name="title" type="text" required="" aria-required="true" value="{{ $goodsInfo->title }}" >
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="cemail" class="control-label col-lg-2"><font><font>副标题</font></font></label>
                                <div class="col-lg-10">
                                    <input class="form-control " id="cemail" type="text" name="subtitle" required="" aria-required="true" value="{{ $goodsInfo->subtitle }}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="curl" class="control-label col-lg-2"><font><font>价格</font></font></label>
                                <div class="col-lg-10">
                                    <input class="form-control goods_price" id="curl" type="url" name="price" value="{{ $goodsInfo->price }}">
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2"><font><font>分类</font></font></label>
                                <div class="col-lg-10">
                                    <select name="class">
                                        @foreach($classList as $item)
                                            @if($goodsInfo->class_id == $item->id)
                                                <option value="{{ $item->id }}" selected="selected">{{ $item->name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2"><font><font>图片</font></font></label>
                                <div class="col-lg-10">
                                    <img style="width: 200px" src="http://jybtest.oss-cn-shanghai.aliyuncs.com/{{ $goodsInfo->pic }}" alt="">
                                    <input class="form-control " type="file" id="curl" name="pic" />
                                </div>
                            </div>
                            <div class="form-group ">
                                <label for="ccomment" class="control-label col-lg-2"><font><font>描述</font></font></label>
                                <div class="col-lg-10">
                                    <textarea name="describe" cols="100%" >{{ $goodsInfo->describe }}</textarea>
                                </div>
                            </div>
                            <input type="hidden" name="guid" value="{{ $goodsInfo->guid }}" />
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button class="btn btn-success goods_edit_btn" type="submit"><font><font>提交</font></font></button>
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
