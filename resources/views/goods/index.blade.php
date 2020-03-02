<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery/2.1.1/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
    <center><h1>学生列表</h1></center>
    <hr />
    
    <hr />
    <table class="table">
        <thead>
        <tr>
            <th>商品ID</th>
            <th>商品名称</th>
            <th>商品货号</th>
            <th>商品价格</th>
            <th>商品图片</th>
            <th>商品相册</th>
            <th>商品库存</th>
            <th>是否精品</th>
            <th>是否热卖</th>
            <th>商品描述</th>
            <th>品牌</th>
            <th>分类</th>
            <th>添加时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->goods_id}}</td>
            <td>{{$v->goods_name}}</td>
            <td>{{$v->goods_no}}</td>
            <td>{{$v->goods_price}}</td>
            <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" height="25"></td>
            <td>
                @if($v->goods_imgs)
                    @php $goods_imgs=explode('|',$v->goods_imgs)@endphp
                        @foreach($goods_imgs as $vv)
                            <img src="{{env('UPLOAD_URL')}}{{$vv}}" height="25">
                    @endforeach
                @endif      
            </td>
            <td>{{$v->goods_inv}}</td>
            <td>{{$v->is_bist==1 ? "是" : "否"}}</td>
            <td>{{$v->is_hot==1 ? "是" : "否"}}</td>
            <td>{{$v->goods_desc}}</td>
            <td>{{$v->brand_name}}</td>
            <td>{{$v->cate_name}}</td>
            <td>{{date('Y-m-d H:i:s', $v->add_time)}}</td>
            <td><a href="{{url('/goods/edit/'.$v->goods_id)}}">编辑</a> |
                <a href="{{url('/goods/destroy/'.$v->goods_id)}}">删除</a></td>
        </tr>
        @endforeach
        </tbody>
        <tr><td colspan="8">{{$data->links()}}</td></tr>
    </table>
</body>
</html>

