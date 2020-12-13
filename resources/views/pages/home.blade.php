@extends('layouts.app')

@section('title' , 'DINO')

@section('content')

        <!-- Header -->
        <header class="text-center">
            <h1>Explore The Beautiful World
                <br>
                As Easy One Click
            </h1>
            <p class="mt-3">
                You will see beautiful moment
                <br>
                That you never see before
            </p>
            <a href="#popularContent" class="btn btn-get-started px-4 mt-4">Get Started</a>
        </header>
        <main>
            <div class="container">
                <section id="stats" class="section-stats row justify-content-center">
                    <div class="col-3 col-md-2 stats-detail">
                        <h2>200k</h2>
                        <p>Members</p>
                     </div>
                    <div class="col-3 col-md-2 stats-detail">
                        <h2>20</h2>
                        <p>Countries</p>
                    </div>
                    <div class="col-3 col-md-2 stats-detail">
                        <h2>3k</h2>
                        <p>Hotels</p>
                    </div>
                    <div class="col-3 col-md-2 stats-detail">
                        <h2>120</h2>
                        <p>Partners</p>
                    </div>
                </section>
            </div>
    
            <section class="section-popular">
                <div class="container">
                    <div class="row">
                        <div class="col text-center section-popular-heading">
                            <h2>Wisata Popular</h2>
                            <p>Something that you never try
                                <br>
                                before in this world
                            </p>
                        </div>
                    </div>
                </div>
            </section>
    
            <section class="section-popular-content" id="popularContent">
                <div class="container">
                    <div class="section-popular-travel row justify-content-center">
                        @foreach ($items->slice(0,4) as $item)
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="card-travel text-center d-flex flex-column" style="background-image: url('{{ $item->galleries->count() ? Storage::url($item->galleries->first()->image) : ''}}">
                                <div class="travel-country">{{ $item->location }}</div>
                                <div class="travel-location">{{ $item->title }}</div>
                                <div class="travel-button mt-auto">
                                    <a href="{{ route('detail',$item->slug) }}" class="btn btn-travel-details px-4">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>
        </main>
    
    
@endsection