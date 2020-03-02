<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<center><h1>编辑品牌页面</h1>
    <form action="{{url('/brand/update/'.$data->brand_id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <table>
            <tr>
                <td>品牌名称</td>
                <td><input type="text" name="brand_name" value="{{$data->brand_name}}"></td>
            </tr>
            <tr>
                <td>品牌LOGO</td>
                <td><img src="{{env('UPLOAD_URL')}}{{$data->brand_logo}}" width="50px" height="50px">
                    <input type="file" name="brand_logo"></td>
            </tr>
            <tr>
                <td>品牌网址</td>
                <td><input type="text" name="brand_url" value="{{$data->brand_url}}"></td>
            </tr>
            <tr>
                <td>品牌描述</td>
                <td><textarea name="brand_desc" cols="30" rows="10">{{$data->brand_desc}}</textarea></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="修改"></td>
            </tr>
        </table>
    </form>
</body>
</html>