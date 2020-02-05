<?php

namespace App\Http\Controllers\Admin\Content;

use App\Http\Controllers\Controller;
use App\Helpers\Posts;
use App\Helpers\Image;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{
    public function validatorCreate(array $data) {
        return Validator::make($data, [
            'head' => ['required', 'string', 'max:250'],
            'head2' => ['required', 'string', 'max:250'],
            'content' => ['nullable', 'string'],
            'category' => ['nullable', 'array'],
            'tags' => ['required', 'string', 'max:250'],
        ]);
    }

    public function add(Posts $post, Request $request)
    {
        if ($request->isMethod('post')) {
            $request_data = $request;
            if ($request->hasFile('photo')) {
                $request_data = $this->uploadImg($request_data);
            }
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminPostsAdd')->withInput($request->all())->withErrors($validator);
            }
            $createPost = $post->create([
                'head' => $request_data->head,
                'head2' => $request_data->head2,
                'photo' => $request_data->photo,
                'content' => $request_data->content,
                'category' => implode(',', $request_data->category),
                'tags' => $request_data->tags,
                'status' => 1,
            ]);
            if ($createPost) {
                return redirect()->route('adminPost')->with('status', 'Новость успешно добавлена.');
            }
        }
    }

    public function update(Posts $posts, Request $request)
    {
        if ($request->isMethod('post')) {
            if ($request->hasFile('photo')) {
                $request->request->add(['photoName'=>$this->uploadImg($request)]);
            } else {
                $request->request->add(['photoName'=>str_replace('/uploads/avatars/', '', $request->preview)]);
            }
            $data = $request->except('_token');
            $validator = $this->validatorCreate($data);
            if ($validator->fails()) {
                return redirect()->route('adminPostsUpdate', $request->id)->withInput($request->all())->withErrors($validator);
            }

            $updatePost = $posts->update($request->id, [
                'head' => $request->head,
                'head2' => $request->head2,
                'photo' => $request->photoName,
                'content' => $request->content,
                'category' => implode(',', $request->category),
                'tags' => $request->tags,
            ]);
            if ($updatePost) {
                return redirect()->route('adminPost')->with('status', 'Новость успешно обновлена.');
            }
        }
    }

    public function uploadImg($request)
    {
        $fileExt = $request->file('photo')->getClientOriginalExtension();
        $fileName = md5(time());
        $destinationPath = '../public/uploads/avatars/';
        $fileName = $fileName.'.'.mb_strtolower($fileExt);
        $request->file('photo')->move($destinationPath, $fileName);

        $image = new Image;
        $image->load($destinationPath.$fileName);
        $image->crop(350, 350);
        $image->save_jpeg($destinationPath.$fileName, 85);

        return $fileName;
    }
}
