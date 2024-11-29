@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Home Section with Fullscreen Carousel -->
    <section id="home">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                @foreach (\App\Models\Banner::all() as $index => $item)
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}"
                        class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : 'false' }}"></button>
                @endforeach
            </div>
            <div class="carousel-inner">
                @foreach (\App\Models\Banner::all() as $index => $item)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src="{{ $item->getFirstMediaUrl('banners', 'large') ?: 'https://via.placeholder.com/1920x500/ff7f7f/333333?text=Default+Slide' }}"
                            class="d-block w-100" alt="Banner {{ $index + 1 }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $item->title ?? 'Default Title' }}</h5>
                            <p>{{ $item->description ?? 'Default description goes here.' }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
@endsection
