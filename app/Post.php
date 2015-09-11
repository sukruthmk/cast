<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Post extends Model
{

   protected $fillable = ['message'];

   public function comments() {
      return $this->hasMany('App\Comment');
   }

   public function locations() {
      return $this->hasMany('App\Location');
   }

   public function user() {
      return $this->belongsTo('App\User');
   }

}

?>
