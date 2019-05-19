<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  protected $fillable = [
      'name','board_id'
  ];

  /**
   * get group tasks
   */
    public function tasks()
    {
      return $this->hasMany('App\Task');
    }
}
