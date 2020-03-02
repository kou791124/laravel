<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Cate;
class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Goods::
            leftjoin('cate','goods.cate_id','=','cate.cate_id')
            ->leftjoin('brand','goods.brand_id','=','brand.brand_id')->paginate(2);
        return view('goods.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brand = Brand::get();
        $cateInfo = Cate::get();
        $cateInfo = $this->GetcateInfo($cateInfo);
        return view('goods.create',['cateInfo'=>$cateInfo,'brand'=>$brand]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->except('_token');
        $data['goods_no'] = $this->CreateGoods();
        if ($request->hasFile('goods_img')) { // }
            $data['goods_img']=$this->upload('goods_img');
        }
        //dd($data);
        if(isset($data['goods_imgs'])){
            $data['goods_imgs']=$this->Moreupload('goods_imgs');
            $data['goods_imgs']=implode('|',$data['goods_imgs']);
        }
        $data['add_time'] = time();
        //dd($data);
        $res=Goods::create($data);
        if($res){
            return redirect('/goods/index');
        }
    }

    // 货号
    public function CreateGoods(){
        return 'shop'.date('YmdHis').rand(1000,9999);
    }

    // 文件上传
    public function upload($filename){
        if (request()->file($filename)->isValid()) {
            $photo = request()->file($filename);
            $store_result = $photo->store('upload');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }

    // 多文件上传
    public function Moreupload($filename){
        $photo=request()->file($filename);
        if(!is_array($photo)){
            return;
        }
        foreach($photo as $v){
            if($v->isValid()){
                $store_result[]=$v->store('upload');
            }
        }
        return $store_result;
    }

    // 无限极分类
    public function GetcateInfo($data,$p_id=0,$level=1){
        if(!$data){
            return;
        }
        static $arr=[];
        foreach($data as $k=>$v){
            if($v->p_id==$p_id){
                $v->level=$level;
                $arr[]=$v;
                $this->GetcateInfo($data,$v->cate_id,$level+1);
            }
        }
        return  $arr;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $goods = Goods::find($id);
        $brand = Brand::get();
        $cateInfo = Cate::get();
        $cateInfo = $this->GetcateInfo($cateInfo);
        return view('goods.edit',['goods'=>$goods,'brand'=>$brand,'cateInfo'=>$cateInfo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data=$request->except('_token');
        $data['goods_no'] = $this->CreateGoods();
        if ($request->hasFile('goods_img')) { // }
            $data['goods_img']=$this->upload('goods_img');
        }
        //dd($data);
        if(isset($data['goods_imgs'])){
            $data['goods_imgs']=$this->Moreupload('goods_imgs');
            $data['goods_imgs']=implode('|',$data['goods_imgs']);
        }
        //dd($data);
        $res=Goods::where('goods_id','=',$id)->update($data);
        if($res!==false){
            return redirect('/goods/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Goods::destroy($id);
        if($res){
            return redirect('/goods/index');
        }
    }
}
