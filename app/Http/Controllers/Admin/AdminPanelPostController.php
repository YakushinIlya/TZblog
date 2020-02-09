<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Navigation;
use App\Model\PostModel;
use App\Model\CategoryModel;
use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem as File;

class AdminPanelPostController extends Controller
{
    public $admNav;

    public function __construct(Navigation $nav)
    {
        $this->admNav = $nav->select('adm');
    }

    public function index(PostModel $post)
    {
        $data = [
            'admNav' => $this->admNav,
            'postsList' => $post->orderBy('id', 'desc')->paginate(5),
            'count' => $post->count(),
        ];
        return view('admin.posts', $data);
    }

    public function add()
    {
        $data = [
            'admNav' => $this->admNav,
            'category' => CategoryModel::pluck('head', 'id'),
        ];
        return view('admin.postsAdd', $data);
    }

    public function update($id)
    {
        $post = PostModel::find($id);
        $post['photo'] = $post['photo'] ? '/uploads/avatars/'.$post['photo'] : '/uploads/avatars/no_photo.jpg';
        $post['category'] = $post->category()->pluck('id');
        $data = [
            'admNav' => $this->admNav,
            'data' => $post,
            'category' => CategoryModel::pluck('head', 'id'),
        ];
        return view('admin.postsUpdate', $data);
    }

    public function open($id)
    {
        if (PostModel::where('id', $id)->update(['status'=>1])) {
            return redirect()->route('adminPost')->with('status', 'Новость успешно опубликована.');
        } else {
            return redirect()->route('adminPost')->withErrors(['Не удалось опубликовать новость.']);
        }
    }

    public function close($id)
    {
        if (PostModel::where('id', $id)->update(['status'=>0])) {
            return redirect()->route('adminPost')->with('status', 'Новость успешно снята с публикации.');
        } else {
            return redirect()->route('adminPost')->withErrors(['Не удалось снять новость с публикации.']);
        }
    }

    public function delete($id, File $file)
    {
        $del = PostModel::find($id);
        $del->delete();
        $file->delete(public_path('uploads/avatars/'.$del->photo));
        return redirect()->route('adminPost')->with('status', 'Новость успешно удалена.');
    }
}
