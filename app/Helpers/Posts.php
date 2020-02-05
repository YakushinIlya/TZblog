<?php

namespace App\Helpers;

use App\Model\PostModel;
use App\Model\CategoryModel;

class Posts
{
    public static function select()
    {
        $Post = PostModel::orderBy('id', 'desc')->limit(10)->get();
        $Cat = new CategoryModel;
        foreach($Post as $ps) {
            $category = explode(',', $ps->category);
            $cat = $Cat->whereIn('id', $category)->get();
            $ps['category'] = $cat;
            $post[] = $ps;
        }

         return $Post;
    }

    public static function create($data)
    {
        $result = PostModel::create($data);
        return $result;
    }

    public static function update($id, $data)
    {
        $result = PostModel::where('id', $id)->update($data);
        return $result;
    }

    public static function open($id)
    {
        $result = PostModel::where('id', $id)->update(['status'=>1]);
        return $result;
    }

    public static function close($id)
    {
        $result = PostModel::where('id', $id)->update(['status'=>0]);
        return $result;
    }

    public static function delete($id)
    {
        PostModel::where('id', $id)->delete();
    }

}