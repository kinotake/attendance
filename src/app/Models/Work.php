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

  public function sumrest()
  {
   
    $time = new Carbon($this->rest_end);
    $time2 = new Carbon($this->rest_start);

    $item = $time->diffInSeconds($time2);
    $h = floor($item/3600);
    $remainder = $item%3600;
    $m = floor($remainder/60);
    $s = $remainder%60;
    $format = "%02d";
    $hours=sprintf($format, $h);
    $minutes=sprintf($format, $m);
    $seconds=sprintf($format, $s);

      return  $hours.":".$minutes.":".$seconds;
    }

}
