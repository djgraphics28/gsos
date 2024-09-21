<div>
    @section('title', 'Create FAQ')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Create FAQs') }}</h1>
        <a href="{{ route('faqs.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to FAQs
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Create New FAQ') }}</h6>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="createFaq">
                <!-- FAQ Key Input -->
                <div class="form-group">
                    <label for="key">{{ __('Question') }}</label>
                    <input type="text" id="key" class="form-control @error('key') is-invalid @enderror"
                        wire:model.defer="key" placeholder="Enter FAQ Key">
                    @error('key')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <!-- FAQ Value Input -->
                <div class="form-group">
                    <label for="value">{{ __('Answer') }}</label>
                    <textarea id="value" class="form-control @error('value') is-invalid @enderror"
                        wire:model.defer="value" placeholder="Enter FAQ Value" rows="5"></textarea>
                    @error('value')<span class="invalid-feedback">{{ $message }}</span>@enderror
                </div>

                <div class="form-group form-check">
                    <input type="checkbox" wire:model="is_active" id="is_active" class="form-check-input">
                    <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
                </div>

                <!-- Submit Button -->
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Create FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
