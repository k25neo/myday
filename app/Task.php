<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $fillable = [
      'name','group_id', 'sum', 'date', 'status'
  ];
  protected $dates = ['date'];
  public static $status = [
      'await' => 'Ожидает',
      'request' => 'В заявке',
      'work' => 'В работе',
      'ready' => 'Готово'
    ];

    /**
     * get group tasks
     */
    public function users()
    {
      return $this->belongsToMany('App\User');
    }

    /**
     * get task comments
     */
    public function comments()
    {
      return $this->hasMany('App\Comment');
    }

    /**
   * get group.
   */
    public function group()
    {
      return $this->belongsTo('App\Group');
    }





}
