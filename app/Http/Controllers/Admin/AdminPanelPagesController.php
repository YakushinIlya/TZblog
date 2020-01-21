<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Contracts\NavigationCntr;
use App\Model\NavigationModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelPagesController extends Controller
{
    public $topNav;
    public $admNav;
    public $listNav;
    public $locationNav = [0=>'Выберите местоположение', 'adm'=> 'Административная часть', 'top'=>'Шапка сайта'];

    public function __construct(NavigationCntr $nav)
    {
        $this->topNav = $nav->select('top');
        $this->admNav = $nav->select('adm');
        $this->listNav = $nav->selectAll();
    }

    public function index()
    {
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
            'pageList' => $this->listNav,
        ];
        return view('admin.pages', $data);
    }

    public function add()
    {
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
            'location' => $this->locationNav,
        ];
        return view('admin.pagesAdd', $data);
    }

    public function update($id)
    {
        $page = NavigationModel::find($id);
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
            'location' => $this->locationNav,
            'data' => $page,
        ];
        return view('admin.pagesUpdate', $data);
    }

    public function delete($id, NavigationCntr $nav)
    {
        $nav->delete($id);
        return redirect()->route('adminPages')->with('status', 'Страница успешно удалена.');
    }
}