<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CateModel;
use Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=CateModel::get();

        $data=$this->createTree($data);

        return view('cate.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
function CreateTree($data,$p_id=0,$level=0){
    if(!$data){
        return;
    }
    static $newarray=[];
    foreach($data as $k=>$v){
        if($v->p_id==$p_id){
            $v->level=$level;
            $newarray[]=$v;
            //调用自身
            $this->CreateTree($data,$v->cate_id,$level+1);
        }
    }
    return $newarray;
}
    public function create()
    {
        $cateInfo=CateModel::get();

        $data=$this->createTree($cateInfo);

        return view('cate.create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post=$request->except('_token');

        $res=CateModel::create($post);

        if($res){
            return redirect('/cate/index');
        }
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
        $cateInfo = CateModel::find($id);

        $data = CateModel::all();

        $data=$this->createTree($data);

        return view('cate.edit',['cateInfo'=>$cateInfo, 'data'=>$data]);
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
        $data = $request->except('_token');

        $res = CateModel::where('cate_id', $id)->update($data);

        if($res){
            return redirect('/cate/index');
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
        $count = CateModel::where('p_id', '=', $id)->count();
//        dd($count);
        if( $count > 1 ){
            exit;
        } else {

            $res = CateModel::destroy($id);

            if ($res) {
                return redirect('/cate/index');
            }
        }
    }

    public function checkOnly(){
        $cate_name = \request()->cate_name??'';

        $count = CateModel::where(['cate_name'=>$cate_name])->count();

        echo json_encode(['code'=>'00000', 'msg'=>'ok', 'count'=>$count]);
    }
}
