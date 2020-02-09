<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Navigation;
use App\Model\CommentsModel;
use App\Http\Controllers\Controller;

class AdminPanelCommentController extends Controller
{
    public $admNav;

    public function __construct(Navigation $nav)
    {
        $this->admNav = $nav->select('adm');
    }

    public function index(CommentsModel $com)
    {
        $data = [
            'admNav' => $this->admNav,
            'commentsList' => $com->orderBy('id', 'desc')->paginate(10),
            'count' => $com->count(),
        ];
        return view('admin.comments', $data);
    }

    public function public($id, CommentsModel $com)
    {
        if ($com->where('id', $id)->update(['status'=>1])) {
            return redirect()->route('adminComment')->with('status', 'Комментарий успешно опубликован.');
        } else {
            return redirect()->route('adminComment')->withErrors(['Не удалось опубликовать комментарий.']);
        }
    }

    public function publicOut($id, CommentsModel $com)
    {
        if ($com->where('id', $id)->update(['status'=>0])) {
            return redirect()->route('adminComment')->with('status', 'Комментарий успешно снят с публикации.');
        } else {
            return redirect()->route('adminComment')->withErrors(['Не удалось снять с публикации комментарий.']);
        }
    }

    public function delete($id, CommentsModel $com)
    {
        $com->where('id', $id)->delete();
        return redirect()->route('adminComment')->with('status', 'Комментарий успешно удален.');
    }
}
