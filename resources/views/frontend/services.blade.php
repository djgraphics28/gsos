@extends('frontend.layouts.app')

@section('title', 'Services')

@section('content')

    <!-- Services Section -->
    <section id="services" class="container mt-5">
        <h2 class="text-center">Our Services</h2>
        <div class="row">
            @foreach($services as $service)
                <div class="col-md-4">
                    <div class="card mb-4">
                        <!-- Check if the service has an image, otherwise use a placeholder -->
                        <img src="{{ $service->getFirstMediaUrl('services', 'thumb') ?: 'https://via.placeholder.com/300' }}" class="card-img-top" alt="{{ $service->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $service->title }}</h5>
                            <p class="card-text">{{ $service->short_description }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

@endsection
