@extends('layouts.app')
@section('title', 'Detail Travel')

@section('content')
<main>
    <section class="section-details-header"></section>
    <section class="section-details-content">
        <div class="container"> 
            <div class="row">
                <div class="col p-0">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                               <a href="{{ route('home') }}" style="text-decoration: none">Home</a> 
                            </li>
                            <li class="breadcrumb-item active">
                                Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 pl-lg-0">
                    <div class="card card-details">
                        <h1>{{ $item->title }}</h1>
                        <p>
                            {{ $item->location }}
                        </p>

                        @if ($item->galleries->count())
                        <div class="gallery">
                            <div class="xzoom-container">
                                <img src="{{ Storage::url($item->galleries->first()->image) }}" 
                                class="xzoom" 
                                id="xzoom-default" 
                                xoriginal="{{ Storage::url($item->galleries->first()->image) }}">
                            </div>
                            <div class="xzoom-thumbs">
                                @foreach ($item->galleries as $gallery)
                                <a href="{{ Storage::url($gallery->image) }}">
                                    <img src="{{ Storage::url($gallery->image) }}" class="xzoom-gallery" 
                                    width="124" xpreview="{{ Storage::url($gallery->image) }}">
                                </a>
                                @endforeach
                            </div>
                        </div>               
                        @endif
                        <h2>Tentang Wisata</h2>
                        <p>{!! $item->about !!}
                        </p>
                        <div class="features row">
                            <div class="col-md-4 border-left">
                                <img src="{{ url('frontend/images/icon-detail-1.jpg') }}" class="features-image" alt="">
                                <div class="description">
                                    <h3>Featured Event</h3>
                                    <p>{{ $item->featured_event }}</p>
                                </div>
                            </div>
                            <div class="col-md-4 border-left">
                                <div class="description">
                                    <img src="{{ url('frontend/images/icon-detail-2.jpg') }}" 
                                    class="features-image" alt="">
                                        <div class="description">
                                            <h3>Language</h3>
                                            <p>{{ $item->language }}</p>
                                        </div>
                                </div>
                            </div>
                            <div class="col-md-4 border-left">
                                <div class="description">
                                <img src="{{ url('frontend/images/icon-detail-3.jpg') }}" class="features-image" alt="">
                                <div class="description">
                                    <h3>Food</h3>
                                    <p>{{ $item->foods }}</p>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 my-2 my-lg-0" >
                    <div class="card card-details card-right">
                        <h2>Trip Information</h2>
                        <hr>
                        <table class="trip-information">
                            <tr>
                                <th width="50%">
                                    Date of Departure
                                </th>
                                <td width="50%" class="text-right">{{ \Carbon\Carbon::create($item->date_of_departure)->format('F n, Y') }}</td>
                            </tr>
                            <tr>
                                <th width="50%">
                                    Duration
                                </th>
                                <td width="50%" class="text-right">{{ $item->duration }}</td>
                            </tr>
                            <tr>
                                <th width="50%">
                                    Type
                                </th>
                                <td width="50%" class="text-right">{{ $item->type }}</td>
                            </tr>
                            <tr>
                                <th width="50%">
                                    Price
                                </th>
                                <td width="50%" class="text-right"> @money($item->price)/pax</td>
                            </tr>
                        </table>
                    </div>
                    <div class="join-container">
                        @auth
                            <form action="{{ route('checkout_process', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-block btn-join-now mt-3 py 2">
                                    Join Now
                                </button>
                            </form>
                        @endauth
                        @guest
                        <a href="{{ route('login') }}" class="btn btn-block btn-join-now mt-3 py-2">
                            Login or Register to Join
                        </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section> 
</main>
@endsection
 
@push('prepend-style')
<link rel="stylesheet" href="{{ url('frontend/libraries/xzoom/xzoom.css') }}">
@endpush

@push('addon-script')
<script src="{{ url('frontend/libraries/xzoom/xzoom.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.xzoom, .xzoom-gallery').xzoom({
            zoomWidth: 500,
            title : false,
            tint : '#333',
            Xoffset: 15
        });
    });
</script>
@endpush