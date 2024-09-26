@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Home Section with Fullscreen Carousel -->
    <section id="home">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/1920x500/ff7f7f/333333?text=Slide+1" class="d-block w-100"
                        alt="Slide 1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide 1 Title</h5>
                        <p>Slide 1 description goes here.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1920x500/7f7fff/333333?text=Slide+2" class="d-block w-100"
                        alt="Slide 2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide 2 Title</h5>
                        <p>Slide 2 description goes here.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/1920x500/7fff7f/333333?text=Slide+3" class="d-block w-100"
                        alt="Slide 3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Slide 3 Title</h5>
                        <p>Slide 3 description goes here.</p>
                    </div>
                </div>
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
