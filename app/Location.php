<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Location extends Model
{

   protected $fillable = ['post_id','lattitude', 'longitude'];
   
}

?>