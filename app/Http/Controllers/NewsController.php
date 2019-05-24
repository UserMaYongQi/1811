<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreNewsPost;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Validation\Rule;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //接收分页数据
        $query=request()->all();
        
        $news_name=$query['news_name']??'';
        $file_name=$query['file_name']??'';
        $page=$query['page']??1;
        // dd($query);
        // dd(Redis::mget(['data','query']));
        $data=Redis::get('data_'.$news_name.'_'.$file_name.'_'.$page);
        // $query=Redis::get('query');
        // $data=unserialize($data);
        //dd($data);
        if(!$data){
            echo 1;
            $where=[];
            if(isset($query['news_name'])){
                $where=[
                    ['news_name','like',"%$query[news_name]%"]
                ];
            }
            if(isset($query['file_name'])){
                $where['file_name']=$query['file_name'];
            }
            $pagesize=config('app.pageSize');

            $data=Db::table('news')->join('kk', 'news.file_id', '=', 'kk.file_id')->where($where)->paginate($pagesize);
             $data=serialize($data);
            // // dd($data);
            
            // // dd(array_keys($arr));
            // // dd($arr);
             Redis::set('data_'.$news_name.'_'.$file_name.'_'.$page,$data);
            }
        $data=unserialize($data);
        //dd($data);
        return view('news/index',['data'=>$data,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Db::table('kk')->get();
        return view('news/create',['data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNewsPost $request)
    {
        $data=$request->except('_token');

        if ($request->hasFile('news_file')){
            $res=$this->uplode('news_file');
            if($res){
                $data['news_file']=$res['imgurl'];
            }
        }
        $data['news_create']=time();
        // dd($data);
        $res=Db::table('news')->insert($data);
        if($res){
            return redirect('/news/index');
        }else{
            return redirect('/news/add');
        }
    }

    public function uplode($file)
    {
        if(request()->file($file)->isValid()){
            $photo = request()->file($file);
            $store_result = $photo->store(date(time()));
            return ['code'=>1,'imgurl'=>$store_result];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        echo 44;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $news_id=request()->news_id;
        $data=Db::table('news')->join('kk', 'news.file_id', '=', 'kk.file_id')->where('news_id',$news_id)->first();
        $date=Db::table('kk')->get();
        // dd($date);
        // dd($data);
        return view('news/edit',['data'=>$data,'date'=>$date]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreNewsPost $request)
    {
        // dd($news_id);
       
        $news_id=$request->news_id;
        //dd($news_id);
        $data=$request->except('_token');
         // dd($data['news_id']);
  

        

      if ($request->hasFile('news_file')){
            $res=$this->uplode('news_file');
            if($res){
                $data['news_file']=$res['imgurl'];
            }
        }

        // dd($data);
        $res=Db::table('news')->where('news_id',$data['news_id'])->update($data);

        return redirect('/news/index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //接收id
        $news_id=request()->news_id;
        $res=Db::table('news')->where('news_id',$news_id)->delete();
        if($res){
            echo json_encode(['content'=>'删除成功','icon'=>1]);
        }else{
            echo json_encode(['content'=>'删除失败','icon'=>2]);
        }
    }

    public function check()
    {
        $tatil=request()->tatil;
        // dd($tatil);
        $res=Db::table('news')->where('news_name',$tatil)->first();
        if($res){
            echo json_encode(['content'=>'该标题已经存在','icon'=>1]);
        }
    }

    public function cate()
    {
        $data=Db::table('create')->get()->toArray();
        // dd($data);
        $res=$this->cateInfo($data);
        // dd($res);
        return view('news/cate',['data'=>$data,'res'=>$res]);
    }


    public function cateInfo($data,$p_id=0,$level=0)
    {
        // dd($data);
        static $arr=[];
        // dd($arr);
        foreach ($data as $k => $v) {
           if($v->p_id==$p_id){
            $arr[]=$v;
            $v->level=$level;
            $this->cateInfo($data,$v->cate_id,$level+1);
           }
        }

        return $arr;
    }


}
