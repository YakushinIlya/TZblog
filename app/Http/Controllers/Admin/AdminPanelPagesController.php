<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Navigation;
use App\Model\NavigationModel;
use App\Http\Controllers\Controller;

class AdminPanelPagesController extends Controller
{
    public $admNav;
    public $locationNav = [0=>'Выберите местоположение', 'adm'=> 'Административная часть', 'top'=>'Шапка сайта'];

    public function __construct(Navigation $nav)
    {
        $this->admNav = $nav->select('adm');
        $this->listNav = $nav->selectAll();
    }

    public function index()
    {
        $data = [
            'admNav' => $this->admNav,
            'pageList' => $this->listNav,
        ];
        return view('admin.pages', $data);
    }

    public function add()
    {
        $data = [
            'admNav' => $this->admNav,
            'location' => $this->locationNav,
        ];
        return view('admin.pagesAdd', $data);
    }

    public function update($id)
    {
        $page = NavigationModel::find($id);
        $data = [
            'admNav' => $this->admNav,
            'location' => $this->locationNav,
            'data' => $page,
        ];
        return view('admin.pagesUpdate', $data);
    }

    public function delete($id, Navigation $nav)
    {
        $nav->delete($id);
        return redirect()->route('adminPages')->with('status', 'Страница успешно удалена.');
    }
}
