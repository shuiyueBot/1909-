<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Types;
use App\Article;
use Illuminate\Validation\Rule;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        //接收搜索数据
        $name=request()->name;
        $types_name=request()->types_name;
        $where=[];
        if($name){
            $where[]=["article_name","like","%$name%"];
        }
        if($types_name){
            $where[]=["types_name","like","%$types_name%"];
        }
        //获取分类数据
        $TypesInfo=Types::get();
        //展示
        $articleData=Article::select("article.*","types.types_name")->
        join("types","article.types_id","=","types.types_id")->
        where($where)->
        paginate(3);
        //返回全部搜索条件
        $query=request()->all();
        return view("article/index",['articleData'=>$articleData,'TypesInfo'=>$TypesInfo,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $TypesInfo=Types::get();
        return view("article.create",['TypesInfo'=>$TypesInfo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $request->validate([
            'article_name'=>
            'required|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:article',
            'article_top'=>'required',
            'types_id'=>'required',
            'is_show'=>'required',
        ],[
            'article_name.required'=>'文章标题必填',
            'article_name.regex'=>'请使用中文或者数字字母下划线2',
            'article_name.unique'=>'该文章已存在',
            'article_top.required'=>'文章重要性必填',
            'types_id.required'=>'文章分类必填',
            'is_show.required'=>'是否显示必填',
        ]
        );
        //接收数据
        $post=$request->except("_token");
        //图片上传
        if($request->file('article_img')){
           $post['article_img'] =uploads('article_img');
        }
        //保存到库中
        // dd($post);
        $res=Article::insert($post);
        // dd($res);
        if($res){
            return \redirect("article/index");
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
        //查询分类数据
        $TypesInfo=Types::get();
        $articleInfo=Article::find($id);
        return view("article/edit",['articleInfo'=>$articleInfo,'TypesInfo'=>$TypesInfo
        ]);
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
        $request->validate([
            'article_name'=>[
            'required',
            'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
            Rule::unique("article")->ignore($id,'article_id'),
            ],
            'article_top'=>'required',
            'types_id'=>'required',
            'is_show'=>'required',
        ],[
            'article_name.required'=>'文章标题必填',
            'article_name.regex'=>'请使用中文或者数字字母下划线2',
            'article_name.unique'=>'该文章已存在',
            'article_top.required'=>'文章重要性必填',
            'types_id.required'=>'文章分类必填',
            'is_show.required'=>'是否显示必填',
        ]
        );
        //接收数据
        $post=$request->except("_token");
        //图片上传
        if($request->file('article_img')){
           $post['article_img'] =uploads('article_img');
        }
        //保存到库中
        // dd($post);
        $res=Article::where("article_id",$id)->update($post);
        // dd($res);
        if($res!==false){
            return \redirect("article/index");
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
        //
    }
    //ajax验证唯一性
    public function CheckOnly(){
       $_name= request()->_name;
       $count= Article::where('article_name',$_name)->count();
       return \json_encode(['code'=>'00000','count'=>$count]);
    }
    //ajax删除
    public function ajaxdelete(){
        $article_id=request()->article_id;
        $res=Article::destroy($article_id);
        echo json_encode(['code'=>00000,'font'=>'删除成功']);
    }
    public function session(){
        session(["login"=>123]);
    }
}
