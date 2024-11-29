<div>
    @section('title', 'Edit Form')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Edit Form') }}</h1>
        <a href="{{ route('forms.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back
        </a>
    </div>

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <!-- Card for Editing Form -->
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h5>Edit Form</h5>
                    </div>
                    <div class="card-body">
                        <form wire:submit.prevent="update">
                            @csrf
                            <!-- Workflow Selection -->
                            <div class="form-group mb-3">
                                <label for="workflow">Select Workflow:</label>
                                <select wire:model="workflow_id" id="workflow" class="form-control">
                                    <option value="">Select Workflow</option>
                                    @foreach ($workflows as $workflow)
                                        <option value="{{ $workflow->id }}" @selected($workflow->id == $form->workflow_id)>
                                            {{ $workflow->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('workflow_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Form Name Input -->
                            <div class="form-group mb-3">
                                <label for="form_name">Form Name:</label>
                                <input type="text" wire:model="form_name" id="form_name" class="form-control"
                                    value="{{ $form->form_name }}" placeholder="Enter form name">
                                @error('form_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Form Fields -->
                            <h3>Form Fields</h3>
                            <div class="row">
                                @foreach ($fields as $index => $field)
                                    <div class="col-md-6">
                                        <div class="dynamic-field border p-3 mb-3">
                                            <!-- Label Field -->
                                            <div class="form-group">
                                                <label for="label-{{ $index }}">Label:</label>
                                                <input type="text" class="form-control"
                                                    id="label-{{ $index }}" wire:model.live="fields.{{ $index }}.label"
                                                    value="{{ $field['label'] }}" placeholder="Enter label">
                                                @error("fields.$index.label")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Placeholder Field -->
                                            <div class="form-group">
                                                <label for="placeholder-{{ $index }}">Placeholder:</label>
                                                <input type="text" class="form-control"
                                                    id="placeholder-{{ $index }}"
                                                    wire:model.live="fields.{{ $index }}.placeholder"
                                                    value="{{ $field['placeholder'] }}" placeholder="Enter placeholder">
                                                @error("fields.$index.placeholder")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Helper Text Field -->
                                            <div class="form-group">
                                                <label for="helper-text-{{ $index }}">Helper Text:</label>
                                                <input type="text" class="form-control"
                                                    id="helper-text-{{ $index }}"
                                                    wire:model.live="fields.{{ $index }}.helper_text"
                                                    value="{{ $field['helper_text'] }}" placeholder="Enter helper text">
                                                @error("fields.$index.helper_text")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Field Type -->
                                            <div class="form-group">
                                                <label for="type-{{ $index }}">Field Type:</label>
                                                <select class="form-control" id="type-{{ $index }}"
                                                    wire:model.live="fields.{{ $index }}.type">
                                                    <option value="text" @selected($field['type'] == 'text')>Textbox</option>
                                                    <option value="select" @selected($field['type'] == 'select')>Select</option>
                                                    <option value="radio" @selected($field['type'] == 'radio')>Radio</option>
                                                    <option value="file" @selected($field['type'] == 'file')>File Upload</option>
                                                    <option value="textarea" @selected($field['type'] == 'textarea')>Textarea</option>
                                                </select>
                                                @error("fields.$index.type")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Dynamic Options for Select and Radio -->
                                            <div class="form-group">
                                                <label>Options:</label>
                                                @foreach ($field['options'] as $optionIndex => $option)
                                                    <div class="input-group mb-2">
                                                        <input type="text" class="form-control"
                                                            wire:model.live="fields.{{ $index }}.options.{{ $optionIndex }}"
                                                            value="{{ $option }}" placeholder="Enter option">
                                                        <div class="input-group-append">
                                                            <button type="button" class="btn btn-danger"
                                                                wire:click="removeOption({{ $index }}, {{ $optionIndex }})">
                                                                Remove
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <button type="button" class="btn btn-primary mt-2"
                                                    wire:click="addOption({{ $index }})">Add
                                                    Option</button>
                                            </div>

                                            <!-- Order Field -->
                                            <div class="form-group">
                                                <label for="order-{{ $index }}">Order:</label>
                                                <input type="number" class="form-control"
                                                    id="order-{{ $index }}" wire:model.live="fields.{{ $index }}.order"
                                                    value="{{ $field['order'] }}">
                                                @error("fields.$index.order")
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Required Checkbox -->
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input"
                                                    id="required-{{ $index }}" wire:model="fields.{{ $index }}.required"
                                                    @checked($field['required'])>
                                                <label class="form-check-label"
                                                    for="required-{{ $index }}">Required</label>
                                            </div>

                                            <!-- Remove Field Button -->
                                            <button type="button" class="btn btn-danger mt-3"
                                                wire:click="removeField({{ $index }})">Remove
                                                Field</button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Add Field Button -->
                            <button type="button" class="btn btn-primary mt-3" wire:click="addField">Add Field</button>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success mt-3 float-right">Update Form</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
