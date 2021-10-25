<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
  protected $table = 'blog';

  public $timestamp = false;

  protected $fillable = ['title', 'image', 'description', 'content'];

  public function User(){
    return $this->belongsTo('App\User','author_id');
  }
}
