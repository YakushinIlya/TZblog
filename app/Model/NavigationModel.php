<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NavigationModel extends Model
{
    protected $table = 'navigation';

    protected $fillable = ['url', 'head', 'class_li', 'class_a', 'location', 'content'];
}
