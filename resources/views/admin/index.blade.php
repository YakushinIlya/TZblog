@extends('layouts.admin-apper')

@section('content')
<div class="container marketing">
    <div class="row">
        <div class="col-12 mt-5">Вы находитесь в панели управления администратора: <strong> {!! Auth::user()->name !!} ({!! Auth::user()->email !!})</strong></div>
    </div>
    <hr class="featurette-divider">
</div>
@endsection