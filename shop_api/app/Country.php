<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
  protected $table = 'country';

  public $timestamp = false;
  
  protected $fillable = [
    'name', 'active'
  ];

  public function users() {
    return $this->hasMany('App\User');
  }
}
