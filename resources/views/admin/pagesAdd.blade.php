@extends('layouts.admin-apper')

@section('content')
<div class="container marketing">
    <div class="row">
        <div class="col-12 mt-5">
            <h1 class="h3">{!! __('Добавление страницы') !!}</h1>
            {!! Form::open(['url' => route('adminPageAdd'), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
            <div class="form-group">
                {!! Form::label('head', 'Заголовок:',['class'=>'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('head', old('head'), ['class' => 'form-control','placeholder'=>'Введите заголовок страницы']) !!}
                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                    </div>
            </div>
            <div class="form-group">
                {!! Form::label('url', 'URL адрес:',['class'=>'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('url', old('url'), ['class' => 'form-control','placeholder'=>'Введите URL адрес страницы']) !!}
                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                    </div>
            </div>
            <div class="form-group">
                {!! Form::label('class_li', 'Класс LI тега:',['class'=>'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('class_li', old('class_li') ?? 'nav-item', ['class' => 'form-control','placeholder'=>'Введите класс LI тега']) !!}
                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                    </div>
            </div>
            <div class="form-group">
                {!! Form::label('class_a', 'Класс A тега:',['class'=>'control-label']) !!}
                    <div class="input-group">
                        {!! Form::text('class_a', old('class_a') ?? 'nav-link', ['class' => 'form-control','placeholder'=>'Введите класс A тега']) !!}
                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                    </div>
            </div>
            <div class="form-group">
                {!! Form::label('location', 'Местоположение:',['class'=>'control-label']) !!}
                    <div class="input-group">
                        {!! Form::select('location', $location, old('location'), ['class' => 'form-control']) !!}
                        <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                    </div>
            </div>
            <div class="form-group">
                {!! Form::label('content', 'Содержимое страницы:',['class'=>'control-label']) !!}
                <div class="input-group">
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
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