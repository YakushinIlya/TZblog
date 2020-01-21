<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Contracts\NavigationCntr;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelController extends Controller
{
    public $topNav;
    public $admNav;

    public function __construct(NavigationCntr $nav)
    {
        $this->topNav = $nav->select('top');
        $this->admNav = $nav->select('adm');
    }

    public function index()
    {
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
        ];
        return view('admin.index', $data);
    }
}
