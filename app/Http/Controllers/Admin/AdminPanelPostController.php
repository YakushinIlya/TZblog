<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Navigation;
use App\Helpers\Posts;
use App\Helpers\Category;
use App\Model\PostModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminPanelPostController extends Controller
{
    public $admNav;
    public $listPost;

    public function __construct(Navigation $nav)
    {
        $this->admNav = $nav->select('adm');
    }

    public function index(Posts $post)
    {
        $data = [
            'admNav' => $this->admNav,
            'postsList' => $post->select(),
        ];
        return view('admin.posts', $data);
    }

    public function add(Category $cat)
    {
        $category = $cat->categoryArray();
        $data = [
            'admNav' => $this->admNav,
            'category' => $category,
        ];
        return view('admin.postsAdd', $data);
    }

    public function update($id, Category $cat)
    {
        $post = PostModel::find($id);
        $category = $cat->categoryArray();
        $post['photo'] = $post['photo'] ? '/uploads/avatars/'.$post['photo'] : '/uploads/avatars/no_photo.jpg';
        $data = [
            'admNav' => $this->admNav,
            'data' => $post,
            'category' => $category,
        ];
        return view('admin.postsUpdate', $data);
    }

    public function open($id, Posts $post)
    {
        if ($post->open($id)) {
            return redirect()->route('adminPost')->with('status', 'Новость успешно опубликована.');
        } else {
            return redirect()->route('adminPost')->withErrors(['Не удалось опубликовать новость.']);
        }
    }

    public function close($id, Posts $post)
    {
        if ($post->close($id)) {
            return redirect()->route('adminPost')->with('status', 'Новость успешно снята с публикации.');
        } else {
            return redirect()->route('adminPost')->withErrors(['Не удалось снять новость с публикации.']);
        }
    }

    public function delete($id, Posts $post)
    {
        $post->delete($id);
        return redirect()->route('adminPost')->with('status', 'Новость успешно удалена.');
    }
}
