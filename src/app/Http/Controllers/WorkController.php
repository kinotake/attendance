<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Http\Requests\WorkRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rest;
use Carbon\Carbon;



class WorkController extends Controller
{   
   public function view()
   { 
      $data =User::name();
      
      return view('start', ['data' => $data]);
   }
       
   public function start(WorkRequest $request)
   {
   $who= Auth::id();
      // ユーザーネームの取得

      
      // すでに出勤済みか調べる
      // 出勤済みの場合
         if(Work::where('user_id',$who)->exists() && Work::where('user_id',$who)->latest()->first()->work_end===null)
         {
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
   if(Work::worker()->latest()->first()->work_end===null)
   {
      Work::worker()->update
      ([
      'work_end'=>now(),
      ]);

      return redirect('/attendance');
   }
   else
   {
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
// orderBy('user_id', 'asc')
   public function index()
   { 
       // $day=今日の日付、ボタンを押すと＋1日になるようにする
      $day = \Carbon\Carbon::today();
       // 今日のuseデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
    
      // 今日のデータが存在しない場合、エラーへ遷移
      if($joinDatas->isEmpty()){

         return view('error');

      }
      else
      {
      
         // データの配列化、user_idだけ取り出す。
         // $arrays =$joinDatas->toArray();
         // user_idだけの配列にする
         // $onlyUsers = array_column($arrays, 'user_id');
         // user_idがだぶらないようにする
         // $unique = array_unique($onlyUsers);
         // 配列の値を０からにする
         // $dayusers = array_values($unique);
      
            // foreach($dayusers as $value);
            // {
               $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
               // $viewdata = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->where('user_id',$value)->get();
      
                  return view('index',compact('viewDatas','day'));       
            }

// ここ！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！！         

      
          
   }

   public function login()
   {
      return view('login');
   }

   
   
   public function personView()
   {
      return view('person');
   }
        
   public function usersView()
   {
         

      return view('users');
   }

  
   // 今日のページの前日ボタンを押したとき
   public function beforeView()
   {  // 今日のデータのページから前日のページを閲覧したい場合
      $day = \Carbon\Carbon::today();   
      $day->subDays(1);
      
      // 今日以外のデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
      
         if(isset($joinDatas))
         {
            $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
                     return view('beforeindex')->with(compact('viewDatas','day'));
                     // return view('beforeindex',compact('viewdata','day'));       
         }
         else
         {
            $nodata="この日のデータは存在しません。";
            return view('beforeindex','nodata',);
         }
    
   }
   public function haveDayView(Request $request)
   {  // いたページから前日のページに遷移したい場合  
      $data = $request->all();
      $day = $data['day'];
      $day = new Carbon($day);
      $day->subDays(1);
      
      // 今日以外のデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
      
         if(isset($joinDatas))
         {
            $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
                     return view('beforeindex')->with(compact('viewDatas','day'));
                     // return view('beforeindex',compact('viewdata','day'));       
         }
         else
         {
            $nodata="この日のデータは存在しません。";
            return view('beforeindex','nodata',);
         }
    
   }
}


