<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data=Brand::get();
        return view('brand.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->except('_token');
        if ($request->hasFile('brand_logo')) {
            $data['brand_logo'] = $this->upload('brand_logo');
        }
        $data['add_time']=time();
        $res=Brand::create($data);
        if($res){
            return redirect('/brand/index');
        }
    }

    public function upload($filename){
        if(request()->file($filename)->isValid()) {
            $photo = request()->file($filename);
            $store_result = $photo->store('upload');
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
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
    public function edit($brand_id)
    {
        //
        $data=Brand::find($brand_id);
        return view('brand.edit',['data'=>$data]);
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
        //
        $data=$request->except('_token');
        if ($request->hasFile('brand_logo')) {
            $data['brand_logo'] = $this->upload('brand_logo');
        }
        //dd($data);
        $res=Brand::where('brand_id',$id)->update($data);
        if($res!==false){
            return redirect('brand/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($brand_id)
    {
        //
        $res=Brand::destroy($brand_id);
        if($res){
            return redirect('/brand/index');
        }
    }
}
