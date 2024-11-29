@extends('frontend.layouts.app')

@section('title', 'Submit Request')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle text-success fa-4x mb-3"></i>
                        <h2 class="card-title">Request Submitted Successfully!</h2>
                        <p class="card-text">Thank you for your submission. Please check your email for further instructions.
                        </p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
