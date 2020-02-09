<?php

namespace App\Http\Controllers;

use App\Model\PostModel;
use App\Helpers\Navigation;
use Illuminate\Http\Request;
use App\User;

class SearchController extends Controller
{
    public $nav;

    public function __construct(Navigation $nav)
    {
        $this->nav = $nav->select('top');
    }

    public function index(Request $request)
    {
        $result = [];
        $search = explode(' ', $request->search);
        foreach($search as $searchTerm){
            $post = PostModel::where('head', 'like', '%'.$searchTerm.'%')
                ->orWhere('head2', 'like', '%'.$searchTerm.'%')
                ->orWhere('content', 'like', '%'.$searchTerm.'%')->get();
            foreach($post as $res) {
                $result[] = $res;
            }
        }
        $data = [
            'topNav' => $this->nav,
            'posts' => $result,
            'user' => new User(),
        ];
        return view('front.search', $data);
    }
}
