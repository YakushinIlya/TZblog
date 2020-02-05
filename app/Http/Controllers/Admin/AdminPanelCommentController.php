<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Navigation;
use App\Helpers\Comments;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelCommentController extends Controller
{
    public $topNav;
    public $admNav;
    public $commentsList;

    public function __construct(Navigation $nav, Comments $com)
    {
        $this->topNav = $nav->select('top');
        $this->admNav = $nav->select('adm');
        $this->commentsList = $com->select();
    }

    public function index()
    {
        $data = [
            'topNav' => $this->topNav,
            'admNav' => $this->admNav,
            'commentsList' => $this->commentsList,
        ];
        return view('admin.comments', $data);
    }

    public function public($id, Comments $com)
    {
        if ($com->public($id)) {
            return redirect()->route('adminComment')->with('status', 'Комментарий успешно опубликован.');
        } else {
            return redirect()->route('adminComment')->withErrors(['Не удалось опубликовать комментарий.']);
        }
    }

    public function delete($id, Comments $com)
    {
        $com->delete($id);
        return redirect()->route('adminComment')->with('status', 'Комментарий успешно удален.');
    }
}
