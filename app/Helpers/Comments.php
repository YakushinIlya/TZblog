<?php

namespace App\Helpers;

use App\Model\CommentsModel;

class Comments
{
    public static function select()
    {
        $Category = CommentsModel::orderBy('id', 'desc')->get();
         return $Category;
    }

    public static function public($id)
    {
        $result = CommentsModel::where('id', $id)->update(['status'=>1]);
        return $result;
    }

    public static function delete($id)
    {
        CommentsModel::where('id', $id)->delete();
    }
}