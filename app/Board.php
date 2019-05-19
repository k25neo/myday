<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
  protected $fillable = [
      'name','description'
  ];

/**
 * get board groups
 */
  public function groups()
  {
    return $this->hasMany('App\Group');
  }
}
