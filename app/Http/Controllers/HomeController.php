<?php

namespace App\Http\Controllers;

use App\Helpers\Navigation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    public function index()
    {
        $data = [
            'topNav' => $this->nav,
        ];
        return view('front.index', $data);
    }
}
