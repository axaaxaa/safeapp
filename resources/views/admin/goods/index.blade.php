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
                                        <th><font><font>标题</font></font></th>
                                        <th><font><font>副标题</font></font></th>
                                        <th><font><font>价格</font></font></th>
                                        <th><font><font>销量</font></font></th>
                                        <th><font><font>编辑</font></font></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($goodsList as $item)
                                        <tr>
                                            <td><font><font>{{ $item->title }}</font></font></td>
                                            <td><font><font>{{ $item->subtitle }}</font></font></td>
                                            <td><font><font>{{ $item->price }}</font></font></td>
                                            <td><font><font>{{ $item->sales }}</font></font></td>
                                            <td><font><font>{{ date('Y-m-d H:i:s',$item->addtime) }}</font></font></td>
                                            <td><font><font><a href="{{ url('/goods') }}/{{$item->guid}}/edit">编辑</a></font></font></td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                                {{ $goodsList->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection