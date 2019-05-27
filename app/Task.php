<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  protected $fillable = [
      'name','group_id', 'sum', 'date'
  ];
  protected $dates = ['date'];
}
