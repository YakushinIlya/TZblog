<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Model\PostModel;
use App\Helpers\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class PostController extends Controller
{
    public function validatorCreate(array $data) {
        return Validator::make($data, [
            'head' => ['required', 'string', 'max:250'],
            'head2' => ['required', 'string', 'max:250'],
            'content' => ['nullable', 'string'],
            'category' => ['nullable', 'array'],
            'tags' => ['nullable', 'string', 'max:250'],
        ]);
    }

    public function add(PostModel $postModel, Request $request)
    {
        $request->request->add(['author'=>Auth::user()->id]);
        if ($request->hasFile('photoFile')) {
            $request->request->add(['photo'=>$this->uploadImg($request)]);
        } else {
            $request->request->add(['photo'=>'no_photo.jpg']);
        }
        $data = $request->except('_token');
        $validator = $this->validatorCreate($data);
        if ($validator->fails()) {
            return redirect()->route('adminPostsAdd')->withInput($request->all())->withErrors($validator);
        }
        $post = $postModel->create($request->all());
        if ($request->input('category')) {
            $post->category()->attach($request->input('category'));
        }
        if ($post) {
            return redirect()->route('adminPost')->with('status', 'Новость успешно добавлена.');
        }
    }

    public function update(Request $request)
    {
        $request->request->add(['author'=>Auth::user()->id]);
        if ($request->hasFile('photoFile')) {
            $request->request->add(['photo'=>$this->uploadImg($request)]);
        } else {
            $request->request->add(['photo'=>str_replace('/uploads/avatars/', '', $request->preview)]);
        }
        $data = $request->except('_token');
        $validator = $this->validatorCreate($data);
        if ($validator->fails()) {
            return redirect()->route('adminPostsUpdate', $request->id)->withInput($request->all())->withErrors($validator);
        }

        $post = PostModel::find($request->id);
        $post->update($request->all());
        $post->category()->detach();
        if ($request->input('category')) {
            $post->category()->attach($request->input('category'));
        }
        return redirect()->route('adminPost')->with('status', 'Новость успешно обновлена.');
    }

    public function uploadImg($request)
    {
        $fileExt = $request->file('photoFile')->getClientOriginalExtension();
        $fileName = md5(time());
        $destinationPath = '../public/uploads/avatars/';
        $fileName = $fileName.'.'.mb_strtolower($fileExt);
        $request->file('photoFile')->move($destinationPath, $fileName);

        $image = new Image;
        $image->load($destinationPath.$fileName);
        $image->crop(350, 350);
        $image->save_jpeg($destinationPath.$fileName, 85);

        return $fileName;
    }
}
