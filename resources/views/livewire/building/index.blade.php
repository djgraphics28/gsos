<div>
    @section('title', 'List of Buildings')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('List of Buildings') }}</h1>
        <a href="{{ route('buildings.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Create New</a>
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Search for buildings...">
    </div>

    <!-- Buildings Table -->
    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Buildings List') }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="usersTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($buildings as $building)
                                    <tr>
                                        <td>{{ $building->id }}</td>
                                        <td>{{ $building->name }}</td>
                                        <td>{{ $building->is_active ? 'Active' : Not-Active }}</td>
                                        <td>
                                            <a href="{{ route('buildings.edit', $building->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button wire:click="alertConfirm({{ $building->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6">No buildings found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $buildings->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
