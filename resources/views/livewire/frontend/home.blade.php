

<div>
    @section('title', 'Manage Frontend Home')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Manage Frontend Home') }}</h1>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card shadow">
                <div class="card-body">
                    <form wire:submit.prevent="saveChanges">
                        <!-- Draggable Banner Section -->
                        <div id="sortable-banners">
                            @forelse ($banners as $key => $item)
                                <div class="card banner-item" data-id="{{ $item['id'] }}" style="margin-bottom: 10px;">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="col-md-3 position-relative">
                                            <!-- Display the banner image or a default gray banner placeholder -->
                                            @if ($item['image'])
                                                <div style="position: relative;">
                                                    <img src="{{ $item['image'] }}" alt="Banner Image" style="width: 100%;">

                                                    <!-- Trash Icon for removing image -->
                                                    <button type="button" wire:click="removeImage({{ $item['id'] }})" class="btn btn-danger" style="position: absolute; top: 5px; right: 5px; border-radius: 50%; background: white; border: none; padding: 5px;">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            @else
                                                <!-- Default gray banner placeholder -->
                                                <div style="background-color: #d3d3d3; width: 300px; height: 150px; display: flex; justify-content: center; align-items: center;">
                                                    <span style="color: #ffffff;">300 x 150</span>
                                                </div>
                                            @endif

                                            <!-- File input for uploading new image -->
                                            <input type="file" wire:model="newImages.{{ $item['id'] }}" class="form-control mt-2">
                                        </div>
                                        <div class="col-md-9">
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" class="form-control" wire:model.lazy="banners.{{ $key }}.title">
                                            </div>
                                            <div class="form-group">
                                                <label>Description</label>
                                                <input type="text" class="form-control" wire:model.lazy="banners.{{ $key }}.description">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No banners available.</p>
                            @endforelse
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-right mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#sortable-banners').sortable({
                items: '.banner-item',
                update: function (event, ui) {
                    let order = $(this).sortable('toArray', { attribute: 'data-id' });
                    @this.set('bannerOrder', order); // Send the new order to Livewire
                }
            });
        });
    </script>
</div>
