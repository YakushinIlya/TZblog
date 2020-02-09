<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostModel extends Model
{
    protected $table = 'post';
    protected $fillable = ['head', 'head2', 'photo', 'content', 'author', 'tags'];

    public function category()
    {
        return $this->belongsToMany('App\Model\CategoryModel', 'category_post', 'id_post', 'id_category');
    }
}
