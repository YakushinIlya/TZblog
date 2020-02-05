@extends('layouts.admin-apper')

@section('content')
<div class="container marketing">
    <div class="row">
        <div class="col-12 mt-5">
            <h1 class="h3">{!! __('Добавление новости') !!}</h1>
            {!! Form::open(['url' => route('adminPostAdd'), 'class'=>'form-horizontal', 'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
            <div class="form-group">
                {!! Form::label('head', 'Заголовок:',['class'=>'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('head', old('head'), ['class' => 'form-control','placeholder'=>'Введите заголовок новости']) !!}
                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                    </div>
            </div>
            <div class="form-group">
                {!! Form::label('head2', 'Подзаголовок:',['class'=>'control-label']) !!}
                <div class="input-group">
                    {!! Form::text('head2', old('head2'), ['class' => 'form-control','placeholder'=>'Введите подзаголовок новости']) !!}
                    <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('photo', 'Превью новости:',['class'=>'control-label']) !!}
                <div class="input-group">
                    {!! Form::file('photo', ['class' => 'form-control', 'accept'=>'image/jpg,image/jpeg,image/JPG,image/JPEG,image/png,image/gif']) !!}
                    <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('content', 'Описание новости:',['class'=>'control-label']) !!}
                <div class="input-group">
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
                    <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('category', 'Категории новости:',['class'=>'control-label']) !!}
                <div class="input-group">
                    {!! Form::select('category[]', $category, [], ['multiple']) !!}
                    <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('tags', 'Теги новости:',['class'=>'control-label']) !!}
                <div class="input-group">
                    {!! Form::text('tags', old('tags'), ['class' => 'form-control','placeholder'=>'Введите теги новости']) !!}
                    <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    {!! Form::submit('Сохранить', ['class' => 'btn btn-success']) !!}
                    <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <hr class="featurette-divider">
</div>
@endsection