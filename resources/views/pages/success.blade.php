@extends('layouts.success')
@section('title','Checkout Success')


@section('content')
<main>
    <div class="section-success d-flex align-items-center">
        <div class="col text-center">
            <h1>Yey! payment success</h1>'
            <p>We've sent you an email for trip instruction <br> please read it well</p>
            <a href="{{ url('/') }}" class="btn btn-home-page mt-3 px-5">Explore the world</a>
        </div>
    </div>
</main>   
@endsection