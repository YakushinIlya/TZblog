@extends('layouts.admin-apper')

@section('content')
<a href="{!! route('adminPagesAdd') !!}" class="btn btn-success">{!! __('Добавить страницу') !!}</a>
<hr>
@if(isset($pageList[0]))
<table class="table">
    <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">Заголовок</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th scope="col" colspan="4">Всего страниц: {!! count($pageList) ?? 0 !!}</th>
    </tr>
        @foreach($pageList as $pages)
            <tr>
                <th scope="row">{!! $pages->id !!}</th>
                <td>{!! $pages->head !!}</td>
                <td>
                    <a href="{!! $pages->url !!}" class="btn btn-primary" target="_blank">{!! __('Просмотр') !!}</a>
                    <a href="{!! route('adminPagesUpdate', ['id'=>$pages->id]) !!}" class="btn btn-warning">{!! __('Редактировать') !!}</a>
                    <a href="{!! route('adminPagesDelete', ['id'=>$pages->id]) !!}" class="btn btn-danger">{!! __('Удалить') !!}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-warning">
        {!! __('Страниц не найдено.') !!}
    </div>
@endif
<hr class="featurette-divider">
@endsection