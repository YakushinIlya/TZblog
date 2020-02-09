@extends('layouts.apper')

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
</div>

<div class="container">
    <div class="row">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <h1 class="col-12">{!! $post->head !!}</h1>
        <div class="col-2" id="photo-post">
            <img src="/uploads/avatars/{!! $post->photo !!}" class="img-thumbnail img-responsive">
        </div>
        <div class="col-10" id="category-post">
            <div class="h4">{!! $post->head2 !!}</div>
            @foreach($post->category as $cat)
                <a href="{!! route('category', ['id'=>$cat->id]) !!}" target="_blank" style="font-size: 80%;">{!! $cat->head !!}</a>,
            @endforeach
            <br>
            <span>{!! $post->tags !!}</span>
            <br>
            <div class="mt-2">
                @if(isset($_COOKIE[$post->id]))
                    <a href="#" class="btn btn-success disabled" role="button" aria-disabled="true">Лайкнуть <span>{!! $post->likes !!}</span></a>
                @else
                    <a href="#" class="btn btn-success likes" role="button" onclick="likes({!! $post->id !!}, {!! $post->likes !!})">Лайкнуть <span>{!! $post->likes !!}</span></a>
                @endif
                <a href="#" class="btn btn-link disabled">Просмотров <span>{!! $post->view !!}</span></a>
            </div>
        </div>
        <div class="col-12 article mt-3">
            {!! $post->content !!}
        </div>
        <div class="col-12">
            <div id="date-post">
                Дата публикации: <span class="badge badge-secondary">{!! $post->created_at !!}</span> |
                Дата редактирования: <span class="badge badge-secondary">{!! $post->updated_at !!}</span> |
                Автор: <a href="{!! route('author', ['id'=>$post->author]) !!}">
                    <span class="badge badge-primary">{!! $user->find($post->author)->name ?? 'No author' !!}</span>
                </a>
            </div>
        </div>
        <div class="col-12 mt-2">
            <a href="{{ URL::previous() }}" class="btn btn-info">Назад</a>
        </div>
    </div>
    <h3 class="mt-5 mb-2">{!! __('Читайте также:') !!}</h3>
    <div class="row">
        @if(isset($recommended[0]))
            @foreach($recommended as $postRec)
                <div class="col-md-3 card">
                    <img src="/uploads/avatars/{!! $postRec['photo'] !!}" alt="{!! $postRec['head'] !!}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{!! $postRec['head'] !!}</h5>
                        <p class="card-text"></p>
                        <a href="{!! route('post', ['id'=>$postRec['id']]) !!}" class="btn btn-primary" role="button">Подробнее</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">
                {!! __('Не найдено рекомендованных записей') !!}
            </div>
        @endif
    </div>
    <h3 class="mt-5 mb-2">{!! __('Комментарии:') !!}</h3>
        <p>
            <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                {!! __('Оставить комментарий') !!}
            </a>
        </p>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                    {!! Form::open(['url'=> route('commentAdd', ['id'=>$post->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
                    <div class="form-group">
                        {!! Form::label('name', 'Ваше имя:',['class'=>'control-label']) !!}
                        <div class="input-group">
                            {!! Form::text('name', old('name'), ['class' => 'form-control','placeholder'=>'Введите ваше имя']) !!}
                            <span class="input-group-addon">
                                            <i class="fa fa-user"></i>
                                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('content', 'Комментарий:',['class'=>'control-label']) !!}
                        <div class="input-group">
                            {!! Form::textarea('content', old('content'), ['class' => 'form-control', 'rows'=>5]) !!}
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

    <div class="row">
        @if(isset($comments[0]))
            @foreach($comments as $comment)
                <div class="col-12 mt-1">
                    <div class="card">
                        <div class="card-body">
                            <strong>{!! $comment->name !!}</strong><br>
                            <div>{!! $comment->content !!}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">
                {!! __('Не найдено комментариев') !!}
            </div>
        @endif
    </div>

    <hr class="featurette-divider">
</div>
@endsection