<?php

namespace App\Http\Controllers;

use App\Helpers\Navigation;

class PageController extends Controller
{
    public $nav;

    public function __construct(Navigation $nav)
    {
        $this->nav = $nav->select('top');
    }

    public function index($page, Navigation $nav)
    {
        $contentPage = $nav->selectPage($page);
        $data = [
            'topNav' => $this->nav,
            'head' => $contentPage[0]->head,
            'content' => $contentPage[0]->content,
        ];
        return view('front.page', $data);
    }
}
