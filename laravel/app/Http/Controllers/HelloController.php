<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Session;
use Cookie;
use DB,Input,Redirect,url,Validator,Request;
use App\Http\Controllers\Controller;
use Storage;
//header("content-type:text/html;charset=utf-8");
class HelloController extends Controller
{
     //增删改查测试
    public function index()
    {
     //echo 111;
      /*  echo 12321321;
      $user=DB::select("select * from user");
        //print_r($user);die;
      $user=json_decode(json_encode($user),true);
        return view('hello.user',['user'=>$user]);*/
        /*$user = DB::select('select * from user');*/
              //print_r($user);die;
/*        DB::insert("insert into user (u_name,u_pwd,email) values ('赵六','1233456','642163146@qq.com')");*/
        /*$id=9;*/
        //DB::update("update user set u_name ='孙八' where u_id = $id");
       /* DB::delete('delete from user WHERE u_id=?',["$id"]);*/
    }
    //留言板
  public function message()
  {
      //echo 111;
    //Request::isMethod('post')
    //$img=Request::file('file');
    //var_dump($img);
     if(Request::isMethod('post'))
      {
            /*$img=Request::file('img');
            //获取文件名称
            $clientName = $img->getClientOriginalName();
            $realPath = $img->getRealPath();
            //获取图片格式
            $entension = $img->getClientOriginalExtension();
            //图片保存路径
            //$mimeTye = $n_file -> getMimeType();
          $path = $img->move( './storage/uploads',$clientName);*/
          $title=Request::input('title');
          $content=Request::input('content');
          $time=date('Y-m-d H:i:s');
          $res = DB::table('message1')->insert(['title' => $title, 'content' => $content, 'time'=>$time]);
          /*$res=DB::insert("insert into message1 (title,content,`time`) values ('$title','$content','$time')");*/
          if($res)
          {
              echo 1;
          }
          else
          {
              echo 0;
          }
      }
      else
      {
          //$arr=DB::select("select * from message1");
          $arr = DB::table('message1')->orderBy('id','desc')->Paginate(3);
          return view('hello.message',['arr'=>$arr]);
      }
  }
  //删除
    public function del()
    {
        $id=Request::get('id');
        DB::table('message1')->where('id',$id)->delete();
        return redirect('/message');
    }
    //即点即改
    public function namely()
    {
      $id=Request::input('id');
      $content=Request::input('val');
      $re=DB::table('message1')->where("id",$id)->update(array('content'=>$content));
      if($re)
      {
        echo 1;
      }
      else
      {
        echo 0;
      }
    }
    //批量删除
    public function delete()
    {
      $id=Request::input('id');
      $str=explode(",",$id);
      foreach($str as $val){
         DB::table("message1")->where("id","=","$val")->delete();
      }
      
    }
    public function img1()
    {
       return view('hello.img');
    }
    public function img()
    {
          $content=request::input('content');
        //文件上传
        $n_file = request::file('img');
        if($n_file->isValid()) {
            //获取文件名称
            $clientName = $n_file->getClientOriginalName();
            $realPath = $n_file->getRealPath();
            //获取图片格式
            $entension = $n_file->getClientOriginalExtension();
            //图片保存路径
            //$mimeTye = $n_file -> getMimeType();
           $newname="./storage/uploads/".$clientName;
            $path = $n_file -> move(base_path().'/storage/uploads',$clientName);
            $res = DB::table('img')->insert(['content' => $content, 'img' => $path]);
            if ($res) {
                return redirect('/img1');
            }
        }
    }
}