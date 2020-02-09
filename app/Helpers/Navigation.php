<?php

namespace App\Helpers;

use App\Model\NavigationModel;

class Navigation
{
    public static function select($loc)
    {
        $navigation = NavigationModel::whereRaw('location=? && status>?', [$loc, 0])
            ->orderBy('id', 'asc')
            ->get();

         return $navigation;
    }

    public static function selectAll()
    {
        $navigation = NavigationModel::orderBy('id', 'desc')->paginate(5);

        return $navigation;
    }

    public static function selectPage($page)
    {
        $navigation = NavigationModel::whereRaw('url=? && status>?', [$page, 0])->get();

        return $navigation;
    }

    public static function create($data)
    {
        $result = NavigationModel::create($data);

        return $result;
    }

    public static function update($id, $data)
    {
        $result = NavigationModel::where('id', $id)->update($data);

        return $result;
    }

    public static function delete($id)
    {
        NavigationModel::where('id', $id)->delete();
    }

}