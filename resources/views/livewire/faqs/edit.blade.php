<div>
    @section('title', 'Edit FAQ')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Edit FAQ') }}</h1>
        <a href="{{ route('faqs.index') }}" class="btn btn-sm btn-secondary">Back to FAQs</a>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Card for Building Editing -->
            <div class="card shadow">
                <div class="card-body">

                    <form wire:submit.prevent="updateFaq">
                        <div class="form-group">
                            <label for="key">{{ __('Question') }}</label>
                            <input type="text" wire:model="key" id="key"
                                class="form-control @error('key') is-invalid @enderror">
                            @error('key')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="value">{{ __('Answer') }}</label>
                            <textarea wire:model="value" id="value" class="form-control @error('value') is-invalid @enderror"></textarea>
                            @error('value')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" wire:model="is_active" id="is_active" class="form-check-input">
                            <label class="form-check-label" for="is_active">{{ __('Active') }}</label>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
