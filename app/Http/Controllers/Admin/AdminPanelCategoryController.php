<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Navigation;
use App\Helpers\Category;
use App\Model\CategoryModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelCategoryController extends Controller
{
    public $topNav;
    public $admNav;
    public $categoryList;

    public function __construct(Navigation $nav, Category $cat)
    {
        $this->topNav = $nav->select('top');
        $this->admNav = $nav->select('adm');
        $this->categoryList = $cat->select();
    }

    public function index()
    {
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
            'categoryList' => $this->categoryList,
        ];
        return view('admin.category', $data);
    }

    public function add()
    {
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
        ];
        return view('admin.categoryAdd', $data);
    }

    public function update($id)
    {
        $cat = CategoryModel::find($id);
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
            'data' => $cat,
        ];
        return view('admin.categoryUpdate', $data);
    }

    public function delete($id, Category $cat)
    {
        $cat->delete($id);
        return redirect()->route('adminCategory')->with('status', 'Категория успешно удалена.');
    }
}
