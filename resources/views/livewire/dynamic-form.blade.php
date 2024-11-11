<div>
    <h1>{{ $formId ? 'Edit' : 'Create' }} Form</h1>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <!-- Form Name -->
                <div class="form-group col-6">
                    <label for="name">Form Name</label>
                    <input type="text" id="name" wire:model="name" class="form-control">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group col-6">
                    <label for="name">Workflow</label>
                    <select name="workflow" id="workflow" wire:model="workflow" class="form-control">
                        <option value="">-- choose --</option>
                        @foreach ($workflows as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('workflow')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Dynamic Fields -->
            <h2>Form Fields</h2>
            <hr>
            <div id="sortable-fields">
                @foreach ($fields as $index => $field)
                    <div class="card mb-2 border-info" wire:key="field-{{ $field['id'] ?? $index }}"
                        data-index="{{ $index }}">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Required?</label>
                            </div>
                            <button type="button" wire:click="removeField({{ $index }})" class="btn btn-danger"
                                aria-label="Remove field">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label>Field Label</label>
                                    <input type="text" wire:model="fields.{{ $index }}.label"
                                        class="form-control">
                                    @error("fields.$index.label")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label>Field Type</label>
                                    <select wire:model.live="fields.{{ $index }}.type" class="form-control">
                                        <option value="textbox">Textbox</option>
                                        <option value="select">Select</option>
                                        <option value="radio">Radio</option>
                                        <option value="file">File</option>
                                    </select>
                                    @error("fields.$index.type")
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col-3">
                                    <label>Placeholder</label>
                                    <input type="text" class="form-control"
                                        wire:model="fields.{{ $index }}.placeholder">
                                </div>

                                {{-- <div class="form-group">
                                    <label>Required?</label>
                                    <input type="checkbox"
                                        wire:model="fields.{{ $index }}.required">
                                </div> --}}

                                @if (in_array($field['type'], ['select', 'radio']))
                                    <div class="form-group col-3">
                                        <label>Options (comma-separated)</label>
                                        <input type="text" wire:model.lazy="fields.{{ $index }}.options"
                                            class="form-control" placeholder="Option1,Option2,Option3">
                                    </div>
                                @endif



                                <div class="form-group col-6">
                                    <label for="">Helper Text</label>
                                    <input class="form-control" type="text" wire:model="fields.{{ $index }}.helper_text">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button type="button" wire:click="addField" class="btn btn-secondary mb-1 mt-3">Add Field</button>

            @if (session()->has('message'))
                <div class="alert alert-success mt-3">{{ session('message') }}</div>
            @endif
        </div>


        <div class="card-footer">
            <button wire:click="saveForm" class="btn btn-primary float-right">Save Form</button>
        </div>
    </div>

</div>

<script>
    document.addEventListener('livewire:init', function() {
        var sortable = new Sortable(document.getElementById('sortable-fields'), {
            animation: 150,
            onEnd: function(evt) {
                let order = Array.from(document.querySelectorAll('#sortable-fields .card')).map((
                    element) => {
                    return element.getAttribute('data-index');
                });
                Livewire.dispatch('reorderFields', {
                    order: order
                });
            }
        });
    });
</script>
