<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model
{
    protected $table = 'comments';
    protected $fillable = ['name', 'id_post', 'content'];
}
