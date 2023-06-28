<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
class Work extends Model
{
  use HasFactory;
  protected $fillable = ['work_start','work_end',];

   protected $dates = [
        'work_start',
        'work_end',
    ];

  public function rests()
  {
    return $this->hasMany('App\Models\Rest');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  public function worker()
  {
    $person = Auth::id();
    $data = Work::where('user_id',$person)->latest()->first();
  //  ログインしているユーザのworkレコード
      return $data;
  }

  public function outputs()
  {
    $outputs=Work::join('rests','rests.work_id','=','works.id')->get();
  }
  // 日付を返さない
  public function sumrest()
  {
  // 休憩時間が複数か
    $day = $this->work_start;
    $value=$this->user_id;
    
    $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->where('user_id',$value)->get();
    
    $howManyRest=$joinDatas->count();
  // 休憩時間一回の場合
      if ($howManyRest == 1)
      {
      // 総休憩時間の算出
        $time = new Carbon($this->rest_end);
        $time2 = new Carbon($this->rest_start);

        $sum = $time->diffInSeconds($time2);
        $h = floor($sum/3600);
        $remainder = $sum%3600;
        $m = floor($remainder/60);
        $s = $remainder%60;
        $zero = "%02d";
        $hours=sprintf($zero, $h);
        $minutes=sprintf($zero, $m);
        $seconds=sprintf($zero, $s);

        $start=$this->work_start->format('H:i:s');
        $end=$this->work_end->format('H:i:s');

      // 総勤務時間の算出
        $time3 = new Carbon($this->work_end);
        $time4 = new Carbon($this->work_start);

      // 休憩時間を含む労働時間
        $sumWork = $time3->diffInSeconds($time4);
      // 休憩時間を差し引く
        $allWork = $sumWork-$sum;

        $h = floor($allWork/3600);
        $remainder=$allWork%3600;
        $m = floor($remainder/60);
        $s = $remainder%60;
        $zero = "%02d";
        $workHours=sprintf($zero, $h);
        $workMinutes=sprintf($zero, $m);
        $workSeconds=sprintf($zero, $s);
      
          return  $this->name.'  '.$start.'  '.$end.'  '.$hours.":".$minutes.":".$seconds.'  '.$workHours.":".$workMinutes.":".$workSeconds;
      } 
      else 
      {
      // 休憩時間複数の場合
      // 総休憩時間の算出
        $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->where('user_id',$value)->get();

        $arrays =$joinDatas->toArray();
      // rest_startだけの配列にする
        $onlyRestStarts = array_column($arrays, 'rest_start');
      // 配列の値を０からにする
        $dayusers = array_values($onlyRestStarts);

        $arraytime = [];
      // 各休憩時間の算出
        foreach($dayusers as $timeOfStart)
        {
      
        $searchDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->where('rest_start',$timeOfStart)->where('user_id',$value)->first();
      
        $timeOfEnd=$searchDatas->rest_end;
        $timeOfStart=$searchDatas->rest_start;

        $time = new Carbon($timeOfEnd);
        $time2 = new Carbon($timeOfStart);

        $item = $time->diffInSeconds($time2);

        $arraytime[] = $item;
        }
      // 休憩時間の計
        $restTimeSum = array_sum($arraytime);
      
        $h = floor($restTimeSum/3600);
        $remainder = $restTimeSum%3600;
        $m = floor($remainder/60);
        $s = $remainder%60;
        $zero = "%02d";
        $hours=sprintf($zero, $h);
        $minutes=sprintf($zero, $m);
        $seconds=sprintf($zero, $s);

        $start=$this->work_start->format('H:i:s');
        $end=$this->work_end->format('H:i:s');

      // 総勤務時間の算出
        $time3 = new Carbon($this->work_end);
        $time4 = new Carbon($this->work_start);

        // 休憩時間を含む労働時間
        $sumWork = $time3->diffInSeconds($time4);
        // 休憩時間を差し引く
        $allWork = $sumWork-$restTimeSum;

        $h = floor($allWork/3600);
        $remainder=$allWork%3600;
        $m = floor($remainder/60);
        $s = $remainder%60;
        $zero = "%02d";
        $workHours=sprintf($zero, $h);
        $workMinutes=sprintf($zero, $m);
        $workSeconds=sprintf($zero, $s);

          return  $this->name.'  '.$start.'  '.$end.'  '.$hours.":".$minutes.":".$seconds.'  '.$workHours.":".$workMinutes.":".$workSeconds;
      }
  }
    // 日付を返す
  public function datesum()
  {
    $day = $this->work_start;
    $value=$this->user_id;
    
    $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->where('user_id',$value)->get();
    
    $howManyRest=$joinDatas->count();
  // 休憩時間一回の場合
      if ($howManyRest == 1)
      {
      // 総休憩時間の算出
        $time = new Carbon($this->rest_end);
        $time2 = new Carbon($this->rest_start);

        $sum = $time->diffInSeconds($time2);
        $h = floor($sum/3600);
        $remainder = $sum%3600;
        $m = floor($remainder/60);
        $s = $remainder%60;
        $zero = "%02d";
        $hours=sprintf($zero, $h);
        $minutes=sprintf($zero, $m);
        $seconds=sprintf($zero, $s);

        $start=$this->work_start->format('H:i:s');
        $end=$this->work_end->format('H:i:s');

      // 総勤務時間の算出
        $time3 = new Carbon($this->work_end);
        $time4 = new Carbon($this->work_start);

      // 休憩時間を含む労働時間
        $sumWork = $time3->diffInSeconds($time4);
      // 休憩時間を差し引く
        $allWork = $sumWork-$sum;

        $h = floor($allWork/3600);
        $remainder=$allWork%3600;
        $m = floor($remainder/60);
        $s = $remainder%60;
        $zero = "%02d";
        $workHours=sprintf($zero, $h);
        $workMinutes=sprintf($zero, $m);
        $workSeconds=sprintf($zero, $s);
      
          return  $this->work_start->format('Y-m-d').'  '.$start.'  '.$end.'  '.$hours.":".$minutes.":".$seconds.'  '.$workHours.":".$workMinutes.":".$workSeconds;
      } 
      else 
      {
      // 休憩時間複数の場合
      // 総休憩時間の算出
        $joinDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->wheredate('work_start',$day)->where('user_id',$value)->get();

        $arrays =$joinDatas->toArray();
      // rest_startだけの配列にする
        $onlyRestStarts = array_column($arrays, 'rest_start');
      // 配列の値を０からにする
        $dayusers = array_values($onlyRestStarts);

        $arraytime = [];
      // 各休憩時間の算出
          foreach($dayusers as $timeOfStart)
          {
      
            $searchDatas = Work::join('rests','rests.work_id','=','works.id')->join('users','works.user_id','=','users.id')->where('rest_start',$timeOfStart)->where('user_id',$value)->first();
      
            $timeOfEnd=$searchDatas->rest_end;
            $timeOfStart=$searchDatas->rest_start;

            $time = new Carbon($timeOfEnd);
            $time2 = new Carbon($timeOfStart);

            $item = $time->diffInSeconds($time2);

            $arraytime[] = $item;
          }
      // 休憩時間の計
          $restTimeSum = array_sum($arraytime);
          
          $h = floor($restTimeSum/3600);
          $remainder = $restTimeSum%3600;
          $m = floor($remainder/60);
          $s = $remainder%60;
          $zero = "%02d";
          $hours=sprintf($zero, $h);
          $minutes=sprintf($zero, $m);
          $seconds=sprintf($zero, $s);

          $start=$this->work_start->format('H:i:s');
          $end=$this->work_end->format('H:i:s');

      // 総勤務時間の算出
          $time3 = new Carbon($this->work_end);
          $time4 = new Carbon($this->work_start);

      // 休憩時間を含む労働時間
          $sumWork = $time3->diffInSeconds($time4);
      // 休憩時間を差し引く
          $allWork = $sumWork-$restTimeSum;

          $h = floor($allWork/3600);
          $remainder=$allWork%3600;
          $m = floor($remainder/60);
          $s = $remainder%60;
          $zero = "%02d";
          $workHours=sprintf($zero, $h);
          $workMinutes=sprintf($zero, $m);
          $workSeconds=sprintf($zero, $s);
      
            return $this->work_start->format('Y-m-d').'  '.$start.'  '.$end.'  '.$hours.":".$minutes.":".$seconds.'  '.$workHours.":".$workMinutes.":".$workSeconds;
      }
  }
}
