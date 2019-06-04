<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
  protected $fillable = [
      'task_id','user_id','comment'
  ];

  /**
    * Получить пользователя, владеющего данным комментарием.
    */
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
