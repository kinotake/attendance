<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Http\Requests\RestRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use Carbon\Carbon;


class RestController extends Controller
{

  public function  restStart(RestRequest $request)
  {
    $who=Work::worker()->id;
      // ユーザーネームの取得
    $item = Work::worker();
      
      //  すでに休憩に入っているか確かめる 
      // 休憩に入っていた場合
      if(Rest::where('work_id',$who)->exists() && Rest::where('work_id',$who)->latest()->first()->rest_end===null)
      {
        $message="既に休憩に入っています。";
               
        return view('restend',compact('message','item'));
      }
      else 
      {
        $data = Work::worker();
        $rest = new Rest();
        $rest->work_id=$data->id;
        $rest->rest_end=null;
        $rest->rest_start=now()->format('Y-m-d H:i:s');
        $rest->save();

        return view('restend',compact('item'));
      }
       
  } 

  public function  restEnd(RestRequest $request)
  {
      // workレコードの入手
    $item = Work::worker();
      //  workテーブルからidを取り出す
    $person = $item->id;

      if(Rest::where('work_id',$person)->latest()->first()->rest_end===null)
      {
      // Restテーブルでidが合致するものの取得
        Rest::where('work_id',$person)->latest()->update
        ([
        'rest_end'=>now(),
        ]);
        return view('reststart',compact('item'));
      }
      else
      {
        $message="休憩終了処理は既にされています。";

        return view('reststart',compact('message','item'));
      }
  } 

    public function errorView()
   {
      return view('error');
   }
 
 

}
