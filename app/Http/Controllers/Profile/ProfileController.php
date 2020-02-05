<?php

namespace App\Http\Controllers\Profile;

use App\Helpers\Navigation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public $nav;

    public function __construct(Navigation $nav)
    {
        $this->nav = $nav->select('top');
    }

    public function index()
    {
        $data = [
            'topNav' => $this->nav,
        ];
        return view('profile.index', $data);
    }
}
