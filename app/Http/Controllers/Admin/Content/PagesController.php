<?php

namespace App\Http\Controllers\Admin\Content;

use App\Helpers\Navigation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class PagesController extends Controller
{
    public function validatorCreate(array $data) {
        return Validator::make($data, [
            'url' => ['required', 'string', 'max:255'],
            'head' => ['required', 'string', 'max:255'],
            'class_li' => ['nullable', 'string', 'max:255'],
            'class_a' => ['nullable', 'string', 'max:255'],
            'location' => ['required', 'string', 'min:1'],
            'content' => ['nullable', 'string'],
        ]);
    }

    public function add(Navigation $nav, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminCategorysAdd')->withInput($request->all())->withErrors($validator);
            }
            if ($nav->create($request->all())) {
                return redirect()->route('adminCategory')->with('status', 'Страница успешно добавлена.');
            }
        }
    }

    public function update(Navigation $nav, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminPagesUpdate')->withInput($request->all())->withErrors($validator);
            }
            $pageUpdate = $nav->update($request->id, [
                'head' => $request->head,
                'url' => $request->url,
                'class_li' => $request->class_li,
                'class_a' => $request->class_a,
                'location' => $request->location,
                'content' => $request->content,
            ]);
            if ($pageUpdate) {
                return redirect()->route('adminPages')->with('status', 'Страница успешно обновлена.');
            }
        }
    }
}
