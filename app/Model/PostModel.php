<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'post';
    protected $fillable = ['head', 'head2', 'photo', 'content', 'category', 'tags', 'status'];
}
