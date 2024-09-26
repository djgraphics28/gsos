@extends('frontend.layouts.app')

@section('title', 'Services')

@section('content')

    <!-- Services Section -->
    <section id="services" class="container mt-5">
        <h2 class="text-center">Our Services</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Service 1">
                    <div class="card-body">
                        <h5 class="card-title">Service 1</h5>
                        <p class="card-text">Description of Service 1 goes here.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Service 2">
                    <div class="card-body">
                        <h5 class="card-title">Service 2</h5>
                        <p class="card-text">Description of Service 2 goes here.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="https://via.placeholder.com/300" class="card-img-top" alt="Service 3">
                    <div class="card-body">
                        <h5 class="card-title">Service 3</h5>
                        <p class="card-text">Description of Service 3 goes here.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
