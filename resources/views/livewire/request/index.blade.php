<div>
    @section('title', 'Manage Requests')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('Manage Requests') }}</h1>
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Search for Requests...">
    </div>

    <!-- Requests Table -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Request List') }}</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>{{ __('Nature of Request') }}</th>
                            <th>{{ __('Requestor') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Assigned To') }}</th>
                            <th>{{ __('Date Assigned') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($serviceRequests as $request)
                            <tr wire:key="{{ $request->id }}">
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->nature_of_request }}</td>
                                <td>{{ $request->requestor_name }}</td>
                                <td>{{ $request->status }}</td>
                                <td>{{ $request->assigned_to }}</td>
                                <td>{{ $request->date_assigned->format('Y-m-d') }}</td>
                                <td>
                                    <button wire:click="openModal({{ $request->id }})" class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                    <button wire:click="deleteRequest({{ $request->id }})" class="btn btn-sm btn-danger">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">{{ __('No Requests found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="mt-3">
                {{ $serviceRequests->links() }}
            </div>
        </div>
    </div>

    @if ($modalOpen)
        <div class="modal fade show d-block" tabindex="-1" role="dialog" style="background: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $requestId ? __('Edit Request') : __('Create Request') }}</h5>
                        <button type="button" class="close" wire:click="$set('modalOpen', false)">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="nature_of_request">{{ __('Nature of Request') }}</label>
                                <input type="text" id="nature_of_request" wire:model.defer="nature_of_request"
                                    class="form-control @error('nature_of_request') is-invalid @enderror">
                                @error('nature_of_request')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="requestor_name">{{ __('Requestor') }}</label>
                                <input type="text" id="requestor_name" wire:model.defer="requestor_name"
                                    class="form-control @error('requestor_name') is-invalid @enderror">
                                @error('requestor_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="status">{{ __('Status') }}</label>
                                <input type="text" id="status" wire:model.defer="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="assigned_to">{{ __('Assigned To') }}</label>
                                <input type="text" id="assigned_to" wire:model.defer="assigned_to"
                                    class="form-control @error('assigned_to') is-invalid @enderror">
                                @error('assigned_to')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="date_assigned">{{ __('Date Assigned') }}</label>
                                <input type="date" id="date_assigned" wire:model.defer="date_assigned"
                                    class="form-control @error('date_assigned') is-invalid @enderror">
                                @error('date_assigned')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="$set('modalOpen', false)">
                            {{ __('Cancel') }}
                        </button>
                        <button type="button" class="btn btn-primary" wire:click="saveRequest">
                            {{ $requestId ? __('Update') : __('Save') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
