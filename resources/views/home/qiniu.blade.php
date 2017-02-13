<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>
    </title>
    <link rel="stylesheet" type="text/css" href="{{ url('/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('/css/highlight.css') }}">

</head>
<body>
<div class="container">
    <div class="body">
        <div class="col-md-12">
            <div id="container">
                <a class="btn btn-default btn-lg col-sm-offset-4" id="pickfiles" href="#" >
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>文件上传</span>
                </a>
            </div>
        </div>



        <!-- left column -->
        <div class="center-block col-md-12">
            <div class="box box-primary">

                <form method="post" action="/qiniu" class="form-horizontal">
                    <input type="hidden" id="domain" value="{{env('QINIU_DOMAIN')}}/">
                    <input type="hidden" id="hlsurl" value="null">
                    <input type="hidden" id="uptoken_url" value="{{URL::route('get_token1')}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="fname" id="fname" value="">
                    <input type="hidden" name="fhash" id="fname" value="">
                    <input type="hidden" name="ftype" id="ftype" value="">
                    <input type="hidden" name="hlsurl" value="null">
                    <input type="hidden" name="length" value="null">

                </form>

            </div>


        </div>




        <div style="display:none" id="success" class="col-md-12">
            <div class="alert-success">
                队列全部文件处理完毕
            </div>
        </div>
        <div class="col-md-12 ">
            <table class="table table-striped table-hover text-left"   style="margin-top:40px;display:none">
                <thead>
                <tr>
                    <th class="col-md-4">文件名</th>
                    <th class="col-md-2">文件大小</th>
                    <th class="col-md-6">详情</th>
                </tr>
                </thead>
                <tbody id="fsUploadProgress">
                </tbody>
            </table>
        </div>
    </div>

</div>


</body>
<script type="text/javascript" src="{{ url('/js/jquery-1.12.2.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/plupload/plupload.full.min.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/plupload/i18n/zh_CN.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/ui.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/qiniu.js') }}"></script>
<script type="text/javascript" src="{{ url('/js/highlight.js') }}"></script>

<script type="text/javascript" src="{{ url('/js/upload.js') }}"></script>
</html>