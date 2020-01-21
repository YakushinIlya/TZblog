@extends('layouts.apper')

@section('content')
<div class="container marketing">
    <div class="row">
        <div class="mt-5">Вы находитесь в профиле пользователя: <strong> {!! Auth::user()->name !!} ({!! Auth::user()->email !!})</strong></div>
    </div>
    <hr class="featurette-divider">
</div>
@endsection