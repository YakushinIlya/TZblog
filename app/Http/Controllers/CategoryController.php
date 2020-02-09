<?php

namespace App\Http\Controllers;

use App\Helpers\Navigation;
use App\Model\CategoryModel;
use App\User;

class CategoryController extends Controller
{
    public $nav;

    public function __construct(Navigation $nav)
    {
        $this->nav = $nav->select('top');
    }

    public function index(CategoryModel $cat)
    {
        $data = [
            'topNav' => $this->nav,
            'categories' => $cat->orderBy('id', 'desc')->paginate(5),
        ];
        return view('front.category', $data);
    }

    public function category($id, CategoryModel $cat)
    {
        $data = [
            'topNav' => $this->nav,
            'posts' => $cat->find($id)->post()->where('status', 1)->orderBy('id', 'desc')->paginate(5),
            'user' => new User(),
        ];
        return view('front.index', $data);
    }
}
