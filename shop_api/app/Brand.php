<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $table = 'brand';

  public $timestamp = false;

  protected $fillable = ['brand_name'];

}
