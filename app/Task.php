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
}
