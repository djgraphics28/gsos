@extends('frontend.layouts.app')

@section('title', 'Submit Request')

@section('content')
    <section class="container" id="home">
        <div class="card mt-4 mb-4">
            <div class="card-header">
                <div class="frm-group">
                    <label for="">Choose Request</label>
                    <select class="form-control" name="" id="">
                        <option value="1">Service Request</option>
                    </select>
                </div>
            </div>
            <div class="card-body">
                @livewire('service-request-form')
            </div>
        </div>
    </section>
@endsection
