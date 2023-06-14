<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Http\Requests\WorkRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class WorkController extends Controller
{   
    public function view()
       { $data =User::name();
      
      
          return view('start', ['data' => $data]);

       }
       
   public function start(WorkRequest $request){
      $who= Auth::id();
      // ユーザーネームの取得

      // $who=Work::worker();
      // $check=$who->work_end;
      // すでに出勤済みか調べる
      // 出勤済みの場合
          if(Work::where('user_id',$who)->exists() && Work::where('user_id',$who)->latest()->first()->work_end===null){
               // $user= Auth::id();
               // $item =Work::where('user_id',$user)->first();
               $item = Work::worker()->latest()->first();
               $message="既に出勤済みです。";
               return view('reststart',compact('message','item'));
           }
      
      // まだ出勤していない場合
      $work = new Work();
      $work->user_id=Auth::id();
      $work->work_end=null;
      $work->work_start=now()->format('Y-m-d H:i:s');
      $work->save();

      $item = Work::worker()->latest()->first();
         
         return view('reststart',compact('item'));
       } 
   public function endView()
       { 
        $person = Auth::id();
         $data = Work::where('user_id',$person)->first();
      
          return view('end',['data' => $data]);

       }

   public function  end(WorkRequest $request)
       {
         if(Work::worker()->latest()->first()->work_end===null){
          Work::worker()->update([
          'work_end'=>now(),
           ]);
          return redirect('/attendance');
         }
         else{
          $message="退勤処理は既にされています。再度出勤する際はもう一度出勤処理を行ってください。";
          return redirect('/attendance')->with(compact('message'));
         }
        
       } 


       public function  restStartView()
       {
         $who = Auth::id();
         $item = Work::where('user_id',$who)->first();
       
        
        return view('reststart',['item' => $item]);
       } 
      
        public function restEndView()
       { 
        $person = Auth::id();
         $data = Work::where('user_id',$person)->first();
      
          return view('index', ['data' => $data]);

       }

    public function index()
       { 
         // $day=今日の日付、ボタンを押すと＋1日になるようにする
         $day=\Carbon\Carbon::today();
         // 今日のuseデータの絞り込み(名前の表示)
         $dayusers=Work::whereDate('work_start', $day)->with(['user'])->get();

         // 今日のworkデータの絞り込み(勤務開始、終了の表示)
         $workdatas=Work::whereDate('work_start', $day)->get();
         //  休憩時間の計算
         $restusers=Work::whereDate('work_start', $day)->with(['rests'])->get();
         //　workデータの中でも、restのデータを持つものを探す　引き算は、複数ある場合足し算する。
         $resttime=$restusers->rest_end-$restusers->rest_start;
         
         
         

          return view('index',compact('workdatas','dayusers') );
       }

    public function login()
       {
          return view('login');
       }

   

        
    
}
