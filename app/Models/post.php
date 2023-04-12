<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Query\JoinClause;

class post extends Model
{
    use HasFactory;

    protected $table = 'post';
    protected $primaryKey = 'postID';


    protected function getPosts()
    {
        return self::with('user')->get();
    }

    public function comments()
    {
        return $this->hasMany(comment::class, 'fromPostID')->join('users', 'users.id', '=', 'comment.byUserID');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'createdByUserID');
    }
}
