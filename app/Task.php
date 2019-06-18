<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $fillable = [
      'name','group_id', 'sum', 'date', 'date_to',
      'status', 'critical', 'work_type'
  ];
  protected $dates = ['date','date_to'];
  public static $status = [
      'await' => 'Ожидает',
      'request' => 'В заявке',
      'work' => 'В работе',
      'ready' => 'Готово'
  ];
  public static $critical = [
      'a' => 'A',
      'b' => 'B',
      'c' => 'C',
      'd' => 'D',
      'e' => 'E'
  ];
  public static $work_type = [
      'repair' => 'Ремонт',
      'refueling' => 'Заправка'
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
