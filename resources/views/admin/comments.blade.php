﻿@extends('layouts.admin-apper')

@section('content')

@if(isset($commentsList[0]))
<table class="table">
    <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">Автор</th>
        <th scope="col">URL адрес</th>
        <th scope="col">Содержание</th>
        <th scope="col">Статус</th>
        <th scope="col">Дата</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="col" colspan="4">Всего комментариев: {!! $count ?? 0 !!}</th>
        </tr>
        @foreach($commentsList as $comment)
            <tr>
                <th scope="row">{!! $comment->id !!}</th>
                <td>{!! $comment->name !!}</td>
                <td>{!! route('post', ['id'=>$comment->id_post]) !!}</td>
                <td>{!! substr($comment->content, 0, 600) !!} ...</td>
                <td>
                    @if($comment->status>0)
                        {!! __('Опубликован') !!}
                    @else
                        {!! __('Ждет одобрения') !!}
                    @endif
                </td>
                <td>{!! $comment->created_at !!}</td>
                <td>
                    @if($comment->status==1)
                        <a href="{!! route('adminCommentPublicOut', ['id'=>$comment->id]) !!}" class="btn btn-warning">{!! __('Снять с публикации') !!}</a>
                    @else
                        <a href="{!! route('adminCommentPublic', ['id'=>$comment->id]) !!}" class="btn btn-warning">{!! __('Опубликовать') !!}</a>
                    @endif
                    <a href="{!! route('adminCommentDelete', ['id'=>$comment->id]) !!}" class="btn btn-danger">{!! __('Удалить') !!}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{!! $commentsList->links() !!}
@else
    <div class="alert alert-warning">
        {!! __('Комментариев не найдено.') !!}
    </div>
@endif
<hr class="featurette-divider">
@endsection