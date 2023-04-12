<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'commentID';
    protected $table = 'comment';


     public function post(){
        return $this->belongsTo('post::class','postID');
      }

    public function user(){
        return $this->belongsTo(User::class,'id','byUserID');
    }

}
