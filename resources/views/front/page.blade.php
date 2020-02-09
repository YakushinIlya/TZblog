@extends('layouts.apper')

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
</div>

<div class="container">
    <div class="row">
        <h1>{!! $head !!}</h1>
        <div class="article">
            {!! $content !!}
        </div>
    </div>
    <hr class="featurette-divider">
</div>
@endsection