    <div>
        <div class="container mt-5">
            <h2 class="text-center mb-4">Service Request Form</h2>

            <form wire:submit.prevent="submit">
                <!-- Requisition Number -->
                <div class="row">
                    {{-- <div class="col-md-6">
                        <label for="requisition_number" class="form-label">Requisition Number</label>
                        <input type="text" disabled id="requisition_number" class="form-control" wire:model="requisition_number">
                        @error('requisition_number')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}

                    <!-- Building ID -->
                    <div class="col-md-6">
                        <label for="building_id" class="form-label">Building</label>
                        <select id="building_id" class="form-select" wire:model="building_id">
                            <option value="">Select Building</option>
                            @if ($buildings)
                                @foreach ($buildings as $building)
                                    <option value="{{ $building->id }}">{{ $building->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('building_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <hr>

                <div class="mb-3">
                    <label for="nature_of_service_requested" class="form-label">Nature of Service Request</label>
                    <div class="container">
                        @if ($natureOfServiceRequests)

                            @foreach ($natureOfServiceRequests as $request)
                                <div class="row mb-3">
                                    <div class="col-12">
                                        <div class="form-check col-md-3">
                                            <!-- Radio button styled as a button -->
                                            <input class="btn-check" type="radio" name="nature_of_service_requested"
                                                value="{{ $request->id }}" id="request{{ $request->id }}"
                                                wire:model.live="selectedRequest" wire:key="request{{ $request->id }}"
                                                autocomplete="off">
                                            <label class="btn btn-outline-primary w-100 text-start"
                                                for="request{{ $request->id }}">

                                                {{ $request->name }}
                                            </label>
                                        </div>
                                        <!-- Service options for the selected request, only enabled if selectedRequest matches -->
                                        <div class="row mt-3">
                                            @foreach ($request->options as $option)
                                                <div class="col-md-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            value="{{ $option->id }}" id="option{{ $option->id }}"
                                                            wire:model.live="selectedOptions"
                                                            wire:key="option{{ $option->id }}"
                                                            @if ($selectedRequest != $request->id) disabled @endif>
                                                        <label class="form-check-label"
                                                            for="option{{ $option->id }}">
                                                            {{ $option->name }}
                                                        </label>
                                                    </div>
                                                    @if (in_array($option->id, $selectedOptions ?? []))
                                                        <div class="mt-2">
                                                            <input type="number" class="form-control"
                                                                wire:model="optionQuantities.{{ $option->id }}"
                                                                placeholder="Quantity" min="1">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach

                                            <!-- Add 'Others' option with an input box -->
                                            <div class="col-md-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="others"
                                                        id="others{{ $request->id }}"
                                                        wire:model.live="selectedOthers.{{ $request->id }}"
                                                        wire:key="others{{ $request->id }}"
                                                        @if ($selectedRequest != $request->id) disabled @endif>
                                                    <label class="form-check-label" for="others{{ $request->id }}">
                                                        Others
                                                    </label>
                                                </div>
                                                <!-- Input box for 'Others', visible only if 'Others' is selected -->
                                                @if (isset($selectedOthers[$request->id]) && $selectedOthers[$request->id] == 'others')
                                                    <input type="text" class="form-control mt-2"
                                                        wire:model="othersInput.{{ $request->id }}"
                                                        placeholder="Please specify...">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

                <hr>

                <!-- Remarks -->
                <div class="mb-3">
                    <label for="request_message" class="form-label">Message</label>
                    <textarea id="request_message" class="form-control" wire:model="request_message"></textarea>
                    @error('request_message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <hr>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

            @if (session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>

    </div>
