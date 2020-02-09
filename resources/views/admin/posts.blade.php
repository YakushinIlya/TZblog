@extends('layouts.admin-apper')

@section('content')
<a href="{!! route('adminPostsAdd') !!}" class="btn btn-success">{!! __('Добавить новость') !!}</a>
<hr>
@if(isset($postsList[0]))
<table class="table">
    <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">IMG</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Категории</th>
        <th scope="col">Дата</th>
        <th scope="col">Лайки</th>
        <th scope="col">Просмотры</th>
        <th scope="col">Статус</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="col" colspan="4">Всего публикаций: {!! $count ?? 0 !!}</th>
    </tr>
        @foreach($postsList as $post)
            <tr>
                <td>
                    <strong>
                        {!! $post->id !!}
                    </strong>
                </td>
                <td>
                    <img src="{!! $post->photo ? '/uploads/avatars/'.$post->photo : '/uploads/avatars/no_photo.jpg' !!}" style="max-width: 50px; max-height: 50px;" class="img-thumbnail">
                </td>
                <td>{!! $post->head !!}</td>
                <td>
                    @foreach($post->category as $cat)
                        <a href="/category/{!! $cat->id !!}" target="_blank" style="font-size: 80%;">{!! $cat->head !!}</a>,
                    @endforeach
                </td>
                <td>{!! $post->created_at !!}</td>
                <td>{!! $post->likes ?? 0 !!}</td>
                <td>{!! $post->view ?? 0 !!}</td>
                <td>
                    @if($post->status>0)
                        {!! __('Открыт') !!}
                    @else
                        {!! __('Закрыт') !!}
                    @endif
                </td>
                <td>
                    <a href="/post/{!! $post->id !!}" target="_blank" class="btn btn-primary">{!! __('Смотреть') !!}</a>
                    @if($post->status<1)
                        <a href="{!! route('adminPostOpen', ['id'=>$post->id]) !!}" class="btn btn-success">{!! __('Открыть') !!}</a>
                    @else
                        <a href="{!! route('adminPostClose', ['id'=>$post->id]) !!}" class="btn btn-secondary">{!! __('Закрыть') !!}</a>
                    @endif
                    <a href="{!! route('adminPostsUpdate', ['id'=>$post->id]) !!}" class="btn btn-warning">{!! __('Редактировать') !!}</a>
                    <a href="{!! route('adminPostDelete', ['id'=>$post->id]) !!}" class="btn btn-danger">{!! __('Удалить') !!}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    {!! $postsList->links() !!}
@else
    <div class="alert alert-warning">
        {!! __('Новостей не найдено.') !!}
    </div>
@endif
<hr class="featurette-divider">
@endsection