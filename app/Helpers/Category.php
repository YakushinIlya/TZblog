<?php

namespace App\Helpers;

use App\Model\CategoryModel;

class Category
{
    public static function select()
    {
        $Category = CategoryModel::orderBy('id', 'desc')->get();
         return $Category;
    }

    public static function create($data)
    {
        $result = CategoryModel::create($data);
        return $result;
    }

    public static function update($id, $data)
    {
        $result = CategoryModel::where('id', $id)->update($data);
        return $result;
    }

    public static function delete($id)
    {
        CategoryModel::where('id', $id)->delete();
    }

    public function categoryArray()
    {
        $categoryArr = [];
        $category = $this->select();

        foreach($category as $catEl) {
            $categoryArr[$catEl->id] = $catEl->head;
        }

        return $categoryArr;
    }

}