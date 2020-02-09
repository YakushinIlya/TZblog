<?php

namespace App\Http\Controllers;

use App\Model\PostModel;
use App\Model\CategoryModel;
use App\Model\CommentsModel;
use App\Helpers\Navigation;
use Illuminate\Http\Request;
use App\User;
use Validator;

class PostController extends Controller
{
    public $nav;

    public function __construct(Navigation $nav)
    {
        $this->nav = $nav->select('top');
    }

    public function index($id)
    {
        $this->view($id);
        $data = [
            'topNav' => $this->nav,
            'post' => PostModel::find($id),
            'recommended' => $this->recommended($id, 4),
            'user' => new User(),
            'comments' => CommentsModel::whereRaw('id_post=? && status=?', [$id, 1])->orderBy('id', 'desc')->get(),
        ];
        return view('front.post', $data);
    }

    public function view($id)
    {
        /*
         * Просмотры считаются от 1 человека 1 раз за 24 часа
         *
         * if (!isset($_COOKIE['view|'.$id])) {
            PostModel::where('id', $id)->increment('view', 1);
            setcookie('view|'.$id, date("Y-m-d"), time()+86400);
        }*/
        PostModel::where('id', $id)->increment('view', 1);
    }

    public function likes(Request $request)
    {
        PostModel::where('id', $request->id)->increment('likes', 1);
    }

    public function categoryPost($Post)
    {
        $Cat = new CategoryModel;
        foreach($Post as $ps) {
            $category = explode(',', $ps->category);
            $cat = $Cat->whereIn('id', $category)->get();
            $ps['category'] = $cat;
            $post[] = $ps;
        }
        return $Post;
    }

    public function recommended($id, $limit)
    {
        $i=0;
        $result = [];
        $resultCat = PostModel::find($id)->category()->get();
        foreach($resultCat as $cat) {
            $resultPost = CategoryModel::find($cat->id)->post()->get()->toArray();
            foreach($resultPost as $post) {
                if ($post['id']!=$id) {
                    $result[] = $post;
                }
                if ($i>=$limit) {
                    break;
                }
                $i++;
            }
        }
        $result = $this->unique_array($result, 'id');
        return $result;
    }

    public function unique_array($array, $key) {
        $temp_array = [];
        $key_array = [];
        $i = 0;
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

    public function comment(CommentsModel $commentsModel, Request $request)
    {
        $request->request->add(['id_post'=>$request->id]);
        $data = $request->except('_token');
        $validator = Validator::make($data, [
            'name' => ['required', 'string', 'max:250'],
            'content' => ['required', 'string'],
        ]);
        if ($validator->fails()) {
            return redirect()->route('post', ['id'=>$request->id])->withInput($request->all())->withErrors($validator);
        }

        $comments = $commentsModel->create($request->all());
        if ($comments) {
            return redirect()->route('post', ['id'=>$request->id])->with('status', 'Комментарий успешно отправлен на модерацию.');
        }
    }
}
