<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Model\CategoryModel;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function validator(array $data) {
        return Validator::make($data, [
            'head' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);
    }

    public function add(CategoryModel $cat, Request $request)
    {
        $data = $request->except('_token');
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->route('adminCategorysAdd')->withInput($request->all())->withErrors($validator);
        }
        if ($cat->create($request->all())) {
            return redirect()->route('adminCategory')->with('status', 'Категория успешно добавлена.');
        }
    }

    public function update(Request $request)
    {
        $data = $request->except('_token');
        $validator = $this->validator($data);
        if ($validator->fails()) {
            return redirect()->route('adminCategory')->withInput($request->all())->withErrors($validator);
        }

        $cat = CategoryModel::find($request->id);
        $cat->update($request->all());
        return redirect()->route('adminCategory')->with('status', 'Категория успешно обновлена.');
    }

}
