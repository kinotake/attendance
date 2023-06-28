<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Http\Requests\WorkRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Http\Request;



class WorkController extends Controller
{   
   public function view()
   { 
      $data =User::name();
      
      return view('start', ['data' => $data]);
   }
       
   public function start(WorkRequest $request)
   {  // ユーザーネームの取得
      
      $day = \Carbon\Carbon::today();
      $who= Auth::id();
      // 今日のデータが存在するか確かめる
      if(Work::where('user_id',$who)->whereday('work_end',$day)->exists())
      {
      return redirect('/error/same');
      }
      else
      {
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
         $message="退勤処理は既にされています。";

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
       
      $day = \Carbon\Carbon::today();
       // 今日のuseデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
    
      // 今日のデータが存在しない場合、エラーへ遷移
         if($joinDatas->isEmpty())
         {

            return view('error');

         }
         else
         {
            $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->paginate(5);
   
            return view('index',compact('viewDatas','day'));       
         }
   }


   
   
   public function personView()
   {
      return view('person');
   }
        
   public function usersView()
   {  // 全部のユーザーを取得
      $users=User::allusers()->paginate(16);
      $counter= 0;

      return view('users')->with(compact('users','counter'));
   }

   public function users(Request $request)
   {
      $data = $request->all();
      // 押したボタンのユーザーid
      $id = $data['id'];
      $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->where('user_id',$id)->paginate(5);

      $name = User::allusers()->where('id',$id)->first();
      
      return view('person')->with(compact('viewDatas','name'));
   }

  
   // 今日のページの前日ボタンを押したとき
   public function beforeView()
   {  // 今日のデータのページから前日のページを閲覧したい場合
      $day = \Carbon\Carbon::today();   
      $day->subDays(1);
      
      // 今日以外のデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
      
         $howManyData=$joinDatas->count();

         if($howManyData > 0)
         {
            $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->paginate(5);
                     return view('beforeindex')->with(compact('viewDatas','day'));
                     // return view('beforeindex',compact('viewdata','day'));       
         }
         else
         {
            $nodata="この日のデータは存在しません。";
            return view('beforeindex')->with(compact('nodata','day'));
         }
    
   }
   public function yesterdayView(Request $request)
   {  // いたページから前日のページに遷移したい場合  
      $data = $request->all();
      $day = $data['day'];
      $day = new Carbon($day);
      $day->subDays(1);
      
      // 今日以外のデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
      
         $howManyData=$joinDatas->count();

         if($howManyData > 0)
         {
            $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->paginate(5);
            
                     return view('beforeindex')->with(compact('viewDatas','day'));
                           
         }
         else
         {
            $nodata="この日のデータは存在しません。";
            return view('beforeindex')->with(compact('nodata','day'));
         }
    
   }

   public function tomorrowView(Request $request)
   {  // いたページから翌日のページに遷移したい場合  
      $data = $request->all();
      $day = $data['day'];
      $day = new Carbon($day);
      $day->addDays(1);
      
      // 該当の日付のデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
      
      $howManyData=$joinDatas->count();

         if($howManyData > 0)
         {
            $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->paginate(5);
                     return view('beforeindex')->with(compact('viewDatas','day'));
                     // return view('beforeindex',compact('viewdata','day'));       
         }
         else
         {
            $nodata="この日のデータは存在しません。";
            return view('beforeindex')->with(compact('nodata','day'));
         }
        
   }

   public function errorSameView()
   {
      return view('samedayerror');
   }

   public function daysView()
   {
   // データがある日付をすべて取得
      $workDatas = Work::get();
      $arrays =$workDatas->toArray();
   // work_startだけの配列を生成
      $datas = array_column($arrays, 'work_start');
      $workstarts = array();

      foreach($datas as $data){
      $onlyDay=substr("$data","0","10");
      $workstarts[]=$onlyDay;
      }
      $unique = array_unique($workstarts);
      $days = array_values($unique);
      
      
      $daysCollection = collect($days);
      $allTodays = $daysCollection->paginate(16);
      // foreach($workDatas as $key=>$workData){
         // $day = new Carbon($workData);
         // $a=$day->format('Y-m-d');
      // }
      $counter= 0;
      // ->format('Y-m-d')->paginate(5);
      
         return view('days')->with(compact('allTodays','counter'));
   }

   public function todayView(Request $request)
   {  // 表示の日付に遷移する場合  
      $data = $request->all();
      $day = $data['allToday'];
      $day = new Carbon($day);
      
      
      // 今日以外のデータの絞り込み
      $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->get();
      
         $howManyData=$joinDatas->count();

         if($howManyData > 0)
         {
            $viewDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->paginate(5);
                     return view('beforeindex')->with(compact('viewDatas','day'));
                     // return view('beforeindex',compact('viewdata','day'));       
         }
         else
         {
            $nodata="この日のデータは存在しません。";
            return view('beforeindex')->with(compact('nodata','day'));
         }
    
   }
}