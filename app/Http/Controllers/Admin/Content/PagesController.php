<?php

namespace App\Http\Controllers\Admin\Content;

use App\Helpers\Contracts\NavigationCntr;
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

    public function add(NavigationCntr $nav, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminPagesAdd')->withInput($request->all())->withErrors($validator);
            }
            if ($nav->create($request->all())) {
                return redirect()->route('adminPages')->with('status', 'Страница успешно добавлена.');
            }
        }
    }

    public function update(NavigationCntr $nav, Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminPagesUpdate')->withInput($request->all())->withErrors($validator);
            }
            if ($nav->update($request->id, $request->all())) {
                return redirect()->route('adminPages')->with('status', 'Страница успешно обновлена.');
            }
        }
    }
}
