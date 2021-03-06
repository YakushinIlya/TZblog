<?php

namespace App\Http\Controllers;

use App\Helpers\Navigation;
use App\Model\PostModel;
use App\User;

class HomeController extends Controller
{
    public $nav;

    public function __construct(Navigation $nav)
    {
        $this->nav = $nav->select('top');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(PostModel $post)
    {
        $data = [
            'topNav' => $this->nav,
            'posts' => $post->where('status', 1)->orderBy('id', 'desc')->paginate(5),
            'user' => new User(),
        ];
        return view('front.index', $data);
    }
}
