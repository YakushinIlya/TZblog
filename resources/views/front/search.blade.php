@extends('layouts.apper')

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
</div>

<div class="container">
    <div class="row">
        @if(isset($posts[0]))
            @foreach($posts as $post)
                <div class="col-12 mb-3">
                    <div class="card">
                        <a href="{!! route('post', ['id'=>$post->id]) !!}">
                            <h5 class="card-header">{!! $post->head !!}</h5>
                        </a>
                        <div class="card-body">
                            @foreach($post->category as $cat)
                                <a href="{!! route('category', ['id'=>$cat->id]) !!}" target="_blank" style="font-size: 80%;">{!! $cat->head !!}</a>,
                            @endforeach
                            <img src="/uploads/avatars/{!! $post->photo ?? 'no_photo.jpg' !!}" width="200px" class="img-thumbnail img-responsive float-md-left mr-3">
                            <h6 class="card-title">{!! $post->head2 !!}</h6>
                            <div class="card-text">{!! preg_replace("/<img (.*?)>/", '', substr($post->content, 0, 400)) !!} ...</div>
                            <a href="{!! route('post', ['id'=>$post->id]) !!}" class="btn btn-primary">Подробнее</a>
                            <div class="clearfix">
                                Дата публикации: <span class="badge badge-secondary">{!! $post->created_at !!}</span> |
                                Автор: <a href="{!! route('author', ['id'=>$post->author]) !!}">
                                    <span class="badge badge-primary">{!! $user->find($post->author)->name ?? 'No author' !!}</span>
                                </a> |
                                Лайков: <span class="badge badge-success">{!! $post->likes !!}</span> |
                                Просмотров: <span class="badge badge-info">{!! $post->view !!}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-warning">
                {!! __('Поиск не дал результатов.') !!}
            </div>
        @endif
    </div>
    <hr class="featurette-divider">
</div>
@endsection