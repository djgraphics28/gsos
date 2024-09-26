@extends('frontend.layouts.app')

@section('title', 'FAQs')

@section('content')
    <!-- FAQs Section -->
    <section id="faqs" class="container mt-5 mb-5">
        <h2 class="text-center">Frequently Asked Questions</h2>
        <div class="accordion" id="faqAccordion">
            @forelse ($faqs as $faq)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $faq->id }}" aria-expanded="false"
                        aria-controls="collapse{{ $faq->id }}">
                        {{ $faq->key }}
                    </button>
                </h2>
                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse"
                    aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">
                        {{ $faq->value }}
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center">No FAQs....</p>
            @endforelse
        </div>
    </section>
@endsection
