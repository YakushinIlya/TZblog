@extends('layouts.admin-apper')

@section('content')
<a href="{!! route('adminCategorysAdd') !!}" class="btn btn-success">{!! __('Добавить категорию') !!}</a>
<hr>
@if(isset($categoryList[0]))
<table class="table">
    <thead>
    <tr>
        <th scope="col">#ID</th>
        <th scope="col">Заголовок</th>
        <th scope="col">URL адрес</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="col" colspan="4">Всего категорий: {!! count($categoryList) ?? 0 !!}</th>
        </tr>
        @foreach($categoryList as $category)
            <tr>
                <th scope="row">{!! $category->id !!}</th>
                <td>{!! $category->head !!}</td>
                <td>{!! route('category', ['id'=>$category->id]) !!}</td>
                <td>
                    <a href="{!! route('adminCategorysUpdate', ['id'=>$category->id]) !!}" class="btn btn-warning">{!! __('Редактировать') !!}</a>
                    <a href="{!! route('adminCategoryDelete', ['id'=>$category->id]) !!}" class="btn btn-danger">{!! __('Удалить') !!}</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <div class="alert alert-warning">
        {!! __('Категорий не найдено.') !!}
    </div>
@endif
<hr class="featurette-divider">
@endsection