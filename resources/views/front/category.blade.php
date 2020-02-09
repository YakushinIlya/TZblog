@extends('layouts.apper')

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
</div>

<div class="container">
    <div class="row">
        @if(isset($categories[0]))
            @foreach($categories as $cat)
                <div class="col-12 mb-3">
                    <div class="card">
                        <a href="{!! route('category', ['id'=>$cat->id]) !!}">
                            <h5 class="card-header">{!! $cat->head !!}</h5>
                        </a>
                        <div class="card-body">
                            {!! $cat->content !!}
                        </div>
                    </div>
                </div>
            @endforeach
                {!! $categories->links() !!}
        @else
            <div class="alert alert-warning">
                {!! __('Категорий не найдено.') !!}
            </div>
        @endif
    </div>
    <hr class="featurette-divider">
</div>
@endsection