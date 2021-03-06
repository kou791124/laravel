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
<center><h1>添加学生信息</h1></center>
<hr/>
<form class="form-horizontal" role="form" action="{{url('/goods/update/'.$goods->goods_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="s_name"
                   placeholder="请输入姓名" name="goods_name" value="{{$goods->goods_name}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品货号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="s_name"
                   placeholder="请输入货号" name="goods_no" value="{{$goods->goods_no}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="s_name"
                   placeholder="请输入价格" name="goods_price" value="{{$goods->goods_price}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品图片</label>
        <div class="col-sm-8">
            <img src="{{env('UPLOAD_URL')}}{{$goods->goods_img}}" height="25">
            <input type="file" class="form-control" id="s_name"
                   placeholder="请输入图片" name="goods_img">
                   
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-8">
            @if($goods->goods_imgs)
                    @php $goods_imgs=explode('|',$goods->goods_imgs)@endphp
                        @foreach($goods_imgs as $vv)
                            <img src="{{env('UPLOAD_URL')}}{{$vv}}" height="25">
                    @endforeach
                @endif      
            <input type="file" class="form-control" id="s_name"
                   placeholder="请输入相册" name="goods_imgs[]" multiple="multiple">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="s_name"
                   placeholder="请输入库存" name="goods_inv" value="{{$goods->goods_inv}}">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-8">
            <input type="radio" name="is_bist" value="1" {{$goods->is_bist==1?'checked':''}}>是
            <input type="radio" name="is_bist" value="2" {{$goods->is_bist==2?'checked':''}}>否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否热卖</label>
        <div class="col-sm-8">
            <input type="radio" name="is_hot" value="1" {{$goods->is_hot==1?'checked':''}}>是
            <input type="radio" name="is_hot" value="2" {{$goods->is_hot==2?'checked':''}}>否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品描述</label>
        <div class="col-sm-8">
            <textarea class="form-control" id="s_name" name="goods_desc">{{$goods->goods_desc}}</textarea>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">品牌</label>
        <div class="col-sm-8">
            <select  class="form-control" id="" name="brand_id">
                <option>--请选择--</option>
                @foreach($brand as $v)
                <option value="{{$v->brand_id}}" {{$goods->brand_id==$v->brand_id?'selected':''}}>{{$v->brand_name}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">分类</label>
        <div class="col-sm-8">
            <select  class="form-control" id="" name="cate_id">
                <option value="">--请选择--</option>
                @foreach($cateInfo as $v)
                <option value="{{$v->cate_id}}" {{$goods->cate_id==$v->cate_id?'selected':''}}>{!! str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;',$v->level*2.5) !!}{{$v->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">编辑</button>
        </div>
    </div>
</form>

</body>
</html>
