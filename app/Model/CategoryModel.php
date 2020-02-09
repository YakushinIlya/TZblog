<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table = 'category';
    protected $fillable = ['head', 'content'];

    public function post()
    {
        return $this->belongsToMany('App\Model\PostModel', 'category_post', 'id_category', 'id_post');
    }
}
