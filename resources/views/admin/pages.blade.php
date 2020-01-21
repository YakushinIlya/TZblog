@extends('layouts.admin-apper')

@section('content')
<div class="container marketing">
    <div class="row">
        <div class="col-12 mt-5">
            <a href="{!! route('adminPagesAdd') !!}" class="btn btn-success">{!! __('Добавить страницу') !!}</a>

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
                @isset($pageList)
                    @foreach($pageList as $pages)
                        <tr>
                            <th scope="row">{!! $pages->id !!}</th>
                            <td>{!! $pages->head !!}</td>
                            <td>{!! $pages->url !!}</td>
                            <td>
                                <a href="{!! route('adminPagesUpdate', ['id'=>$pages->id]) !!}" class="btn btn-warning">{!! __('Редактировать') !!}</a>
                                <a href="{!! route('adminPagesDelete', ['id'=>$pages->id]) !!}" class="btn btn-danger">{!! __('Удалить') !!}</a>
                            </td>
                        </tr>
                    @endforeach
                @endisset
                </tbody>
            </table>
        </div>
    </div>
    <hr class="featurette-divider">
</div>
@endsection