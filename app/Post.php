<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name by default it is posts
    protected $table = 'posts';
    //Primary key --change the name of id field
    public $primarykey = 'id';
    //specify Timestamps or turn it off/on
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    } 
}
