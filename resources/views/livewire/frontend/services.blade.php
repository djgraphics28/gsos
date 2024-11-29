<div>
    @section('title', 'Manage Frontend Services')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Manage Frontend Services') }}</h1>

        <button wire:click="openModal" class="btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create New Service
        </button>
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Search for Services...">
    </div>

    <!-- Services Table -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Services List') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Short Description') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr wire:key="{{ $service->id }}">
                                <td>{{ $service->id }}</td>
                                <td>
                                    <img id="image"
                                        src="{{ $service->getFirstMediaUrl('services') ?: 'https://via.placeholder.com/150' }}"
                                        alt="image" class="img-thumbnail" width="50" height="50">
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->short_description }}</td>
                                <td>
                                    <button wire:click="openModal({{ $service->id }})" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button wire:click="deleteService({{ $service->id }})"
                                        class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">{{ __('No Services found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-3">
                {{ $services->links() }}
            </div>
        </div>
    </div>

    @if ($modalOpen)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $serviceId ? __('Edit Service') : __('Create Service') }}</h5>
                        <button type="button" class="close" wire:click="$set('modalOpen', false)">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input type="text" id="title" wire:model.defer="title"
                                    class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="shortDescription">{{ __('Short Description') }}</label>
                                <textarea id="shortDescription" wire:model.defer="shortDescription"
                                    class="form-control @error('shortDescription') is-invalid @enderror"></textarea>
                                @error('shortDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="fullDescription">{{ __('Full Description') }}</label>
                                <textarea id="fullDescription" wire:model.defer="fullDescription"
                                    class="form-control summernote @error('fullDescription') is-invalid @enderror"></textarea>
                                @error('fullDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="image">{{ __('Service Image') }}</label>
                                <input type="file" id="image" wire:model="image"
                                    class="form-control-file @error('image') is-invalid @enderror">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" alt="Image Preview"
                                        class="img-thumbnail mt-2" width="150">
                                @elseif ($serviceId)
                                    <img src="{{ $services->find($serviceId)?->getFirstMediaUrl('services', 'thumb') ? $services->find($serviceId)?->getFirstMediaUrl('services', 'thumb') : 'https://via.placeholder.com/150' }}"
                                        alt="Image Preview" class="img-thumbnail mt-2" width="150">
                                @endif
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('modalOpen', false)">
                            {{ __('Cancel') }}
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="saveService">
                            {{ $serviceId ? __('Update') : __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        document.addEventListener('livewire:load', function () {
            // Initialize Summernote editor
            $('#fullDescription').summernote({
                height: 300, // Set the editor height
                callbacks: {
                    onChange: function(contents, $editable) {
                        // Update Livewire property when Summernote content changes
                        @this.set('fullDescription', contents);
                    }
                }
            });

            // Reset editor content when resetEditor event is triggered
            Livewire.on('resetEditor', function () {
                $('#fullDescription').summernote('reset');
            });
        });
    </script>
@endpush
