<?php

namespace App\Helpers;

use App\Helpers\Contracts\NavigationCntr;
use App\Model\NavigationModel;

class Navigation implements NavigationCntr
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
        $navigation = NavigationModel::orderBy('id', 'desc')->get();

        return $navigation;
    }

    public static function create($data)
    {
        $result = NavigationModel::create($data);
        return $result;
    }

    public static function update($id, $data)
    {
        $result = NavigationModel::find($id)->update($data);
        return $result;
    }

    public static function delete($id)
    {
        NavigationModel::find($id)->delete();
    }

}