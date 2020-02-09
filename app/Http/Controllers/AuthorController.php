<?php

namespace App\Http\Controllers;

use App\Helpers\Navigation;
use App\Model\PostModel;
use App\User;

class AuthorController extends Controller
{
    public $nav;

    public function __construct(Navigation $nav)
    {
        $this->nav = $nav->select('top');
    }

    public function index($id, PostModel $post)
    {
        $data = [
            'topNav' => $this->nav,
            'posts' => $post->whereRaw('author=? && status=?', [$id, 1])->orderBy('id', 'desc')->paginate(5),
            'user' => new User(),
        ];
        return view('front.index', $data);
    }
}
