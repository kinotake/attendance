<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
  use HasFactory;
    protected $fillable = ['rest_end'];

    public function work()
    {
      return $this->belongsTo('App\Models\Work');
    }
   
    public function user()
    {
      return $this->hasManyThrough(User::class,Work::class);
    }

}
