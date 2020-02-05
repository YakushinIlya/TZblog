<?php

namespace App\Http\Controllers\Admin\Content;

use App\Helpers\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    public function validatorCreate(array $data) {
        return Validator::make($data, [
            'head' => ['required', 'string', 'max:255'],
            'content' => ['nullable', 'string'],
        ]);
    }

    public function add(Category $cat, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminCategorysAdd')->withInput($request->all())->withErrors($validator);
            }
            if ($cat->create($request->all())) {
                return redirect()->route('adminCategory')->with('status', 'Категория успешно добавлена.');
            }
        }
    }

    public function update(Category $cat, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminCategorysUpdate')->withInput($request->all())->withErrors($validator);
            }
            $categoruUpdate = $cat->update($request->id, [
                'head' => $request->head,
                'content' => $request->content,
            ]);
            if ($categoruUpdate) {
                return redirect()->route('adminCategory')->with('status', 'Категория успешно обновлена.');
            }
        }
    }

}
