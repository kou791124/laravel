<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<center><h1>商品展示页面</h1>
    <table border="1px">
        <tr>
            <td>品牌id</td>
            <td>品牌名称</td>
            <td>品牌LOGO</td>
            <td>品牌网址</td>
            <td>品牌介绍</td>
            <td>添加时间</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr @if($k%2==0) bgcolor="#7fff00" @else bgcolor="#6495ed" @endif>
            <td>{{$v->brand_id}}</td>
            <td>{{$v->brand_name}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->brand_logo}}" width="50px" height="50px"></td>
            <td>{{$v->brand_url}}</td>
            <td>{{$v->brand_desc}}</td>
             <td>{{date("Y-m-d H:i:s",$v->add_time)}}</td>
            <td>
                <a href="{{url('/brand/destroy/'.$v->brand_id)}}">删除</a>
                <a href="{{url('/brand/edit/'.$v->brand_id)}}">编辑</a>
            </td>
        </tr>
         @endforeach
    </table>
</body>
</html>