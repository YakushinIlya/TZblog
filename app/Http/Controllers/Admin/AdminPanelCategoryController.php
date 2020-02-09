<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Navigation;
use App\Model\CategoryModel;
use App\Http\Controllers\Controller;

class AdminPanelCategoryController extends Controller
{
    public $admNav;

    public function __construct(Navigation $nav)
    {
        $this->admNav = $nav->select('adm');
    }

    public function index(CategoryModel $cat)
    {
        $data = [
            'admNav' => $this->admNav,
            'categoryList' => $cat->orderBy('id', 'desc')->paginate(5),
            'cat' => $cat,
            'count' => $cat->count(),
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

    public function delete($id, CategoryModel $cat)
    {
        $cat->where('id', $id)->delete();
        return redirect()->route('adminCategory')->with('status', 'Категория успешно удалена.');
    }
}
