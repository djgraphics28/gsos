<div class="dynamic-field border p-3 mb-3">
    <!-- Label Field -->
    <div class="form-group">
        <label for="label-{{ $index }}">Label:</label>
        <input type="text" class="form-control" id="label-{{ $index }}" wire:model.live="field.label"
            placeholder="Enter label">
        @error("fields.$index.label")
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Placeholder Field -->
    <div class="form-group">
        <label for="placeholder-{{ $index }}">Placeholder:</label>
        <input type="text" class="form-control" id="placeholder-{{ $index }}"
            wire:model.live="field.placeholder" placeholder="Enter placeholder">
        @error("fields.$index.placeholder")
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Helper Text Field -->
    <div class="form-group">
        <label for="helper-text-{{ $index }}">Helper Text:</label>
        <input type="text" class="form-control" id="helper-text-{{ $index }}"
            wire:model.live="field.helper_text" placeholder="Enter helper text">
        @error("fields.$index.helper_text")
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Field Type -->
    <div class="form-group">
        <label for="type-{{ $index }}">Field Type:</label>
        <select class="form-control" id="type-{{ $index }}" wire:model.live="field.type">
            <option value="text">Textbox</option>
            <option value="select">Select</option>
            <option value="radio">Radio</option>
            <option value="file">File Upload</option>
            <option value="textarea">Textarea</option>
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
                <input type="text" class="form-control" wire:model.live="field.options.{{ $optionIndex }}"
                    placeholder="Enter option">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger"
                        wire:click="removeOption({{ $index }}, {{ $optionIndex }})">
                        Remove
                    </button>
                </div>
            </div>
        @endforeach

        <button type="button" class="btn btn-primary mt-2" wire:click="addOption({{ $index }})">Add
            Option</button>
    </div>

    <!-- Order Field -->
    <div class="form-group">
        <label for="order-{{ $index }}">Order:</label>
        <input type="number" class="form-control" id="order-{{ $index }}" wire:model.live="field.order">
        @error("fields.$index.order")
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <!-- Required Checkbox -->
    <div class="form-check">
        <input type="checkbox" class="form-check-input" id="required-{{ $index }}" wire:model="field.required">
        <label class="form-check-label" for="required-{{ $index }}">Required</label>
    </div>

    <!-- Remove Field Button -->
    <button type="button" class="btn btn-danger mt-3" wire:click="removeField({{ $index }})">Remove
        Field</button>
</div>
