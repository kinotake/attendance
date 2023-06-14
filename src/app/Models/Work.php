<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Work extends Model
{
    use HasFactory;
    protected $fillable = ['work_start','work_end',];

    public function rests(){
  return $this->hasMany('App\Models\Rest');
}

 

public function user(){
  return $this->belongsTo('App\Models\User');
}

public function worker(){
   $person = Auth::id();
   $data = Work::where('user_id',$person)->latest()->first();
  //  ログインしているユーザのworkレコード
 
    return $data;
}

public function days(){
    
}
}
