<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests\StoreShopPost;
use App\Shop;
use Illuminate\Support\Facades\Cookie;
class BrandController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $name=Cookie::get('name');
        // dd($name);
        
        
        // $value=Cookie::queue(Cookie::forget('name'));
        // dd($value);
        // dd($value);
        // $value = request()->session()->all();
        // dd($value);
        // $name=request()->session()->flush();
        // dd($name);
        //接收搜索条件
        $query=request()->all();
        $page=request()->page??'1';
        
        
        // dd($query);
        $where=[];
        if(isset($query['brand_name'])){
            $where=[
                ['brand_name','like',"%$query[brand_name]%"]
            ];
        }
        if(isset($query['brand_url'])){
            $where['brand_url']=$query['brand_url'];
        }

        $pagesize=config('app.pageSize');
        // Db::connection()->enableQueryLog();
        $data=Shop::where($where)->orderBy('brand_id','desc')->paginate($pagesize);
        // $logs=Db::getQueryLog();
        // dd($logs);   
        if(request()->ajax()){
            return view('brand/ajaxshow',['data'=>$data,'query'=>$query]);
        }   
        return view('brand/show',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
        return view('brand/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Cookie::queue('name', '学院君', 12);
        // request()->session()->put('name', 'kkkkk');
        // request()->session()->put('names', 'sssss');
        // session(['name'=>'ssssssssss']);
        $data=request()->except('_token');
        //表单验证-2
        $validator = \Validator::make($request->all(), [
            'brand_name' => 'required|unique:shop|max:255',
            'brand_url' => 'required',
            'brand_logo' => 'required',
            'brand_desc' => 'required'
            ],[
            'brand_name.required'=>'商品名称不能为空',
            'brand_name.unique'=>'商品名称已经存在',
            'brand_name.max'=>'商品名称超过最大值',
            'brand_url.required'=>'商品url不能为空',
            'brand_logo.required'=>'商品logo不能为空',
            'brand_desc.required'=>'商品详情不能为空',
            ]);
            // dd($validator->fails());
            if ($validator->fails()) {
            return redirect('brand/add')
            ->withErrors($validator)
            ->withInput();
        }
        //表单验证-1
        // $validatedData = $request->validate([
        // 'brand_name' => 'required|unique:shop|max:255',
        // 'brand_logo' => 'required',
        // 'brand_url' => 'required',
        // 'brand_desc' => 'required'
        // ],[
        // 'brand_name.required'=>'商品名称不能为空',
        // 'brand_name.unique'=>'商品名称已经存在',
        // 'brand_name.max'=>'商品名称长度过长',
        // 'brand_logo.required'=>'商品logo不能为空',
        // 'brand_url.required'=>'商品网址不能为空',
        // 'brand_desc.required'=>'商品详情不能为空'
        // ]);
        if( $request->hasFile('brand_logo') ){
            $res=$this->uplode('brand_logo');
            if($res['code']){
                $data['brand_logo']=$res['imgurl'];
            }
        }

        // $res=Db::table('shop')->insert($data);
        $shop = new Shop; 
        $data['created_at']=time();
        $shop->brand_name= $data['brand_name']; 
        $shop->brand_url= $data['brand_url'];
        $shop->brand_logo= $data['brand_logo'];
        $shop->brand_desc= $data['brand_desc']; 
        $shop->created_at= $data['created_at']; 
        $res=$shop->save($data);
        
        // dd($data);
        // $res=Shop::create($data);
        // dd($res);
        if($res){
            return redirect('/brand/show');
        }
    }


    public function uplode($file)
    {
        if(request()->file($file)->isValid()){
            $photo = request()->file($file);
            // dd($photo);
            $store_result = $photo->store(date('Ymd'));
            // dd($store_result);
            // $store_result = $photo->storeAs('photo', 'test.jpg');
            return ['code'=>1,'imgurl'=>$store_result];
        }else{
            return ['code'=>0,'message'=>'上传过程出错'];
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
        echo 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $brand_id=request()->input('brand_id');

        $data=Db::table('shop')->where('brand_id',$brand_id)->get();
        foreach ($data as $v) {
            
        }
        return view('brand/update',['data'=>$v]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        
        $data=request()->except('_token');
        // dd($data);
        if( request()->hasFile('brand_logo') ){
            $res=$this->uplode('brand_logo');
            if($res['code']){
                $data['brand_logo']=$res['imgurl'];
            }
        }
        
        $res=Db::table('shop')->where('brand_id',$data['brand_id'])->update($data);
        if($res){
            return redirect('/brand/show');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $brand_id=request()->post();
        // dd($brand_id);
        $res=DB::table('shop')->where('brand_id',$brand_id)->delete();
        if($res){
            return redirect('/brand/show');
        }
    }



    public function xq($brand_id)
    {
        dd($brand_id);
    }
}
