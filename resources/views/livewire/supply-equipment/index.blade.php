<div>
    @section('title', 'List of Supplies & Equipment')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('List of Supplies & Equipment') }}</h1>
        @can('create supply and equipments')
            <a href="{{ route('supply-and-equipments.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create New
            </a>
        @endcan
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live="searchTerm" class="form-control"
            placeholder="Search for supplies & equipment...">
    </div>

    <!-- Supplies & Equipment Table -->
    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Supplies & Equipment List') }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="suppliesTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Quantity') }}</th>
                                    <th>{{ __('Unit') }}</th>
                                    <th>{{ __('Building') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($supplies as $supply)
                                    <tr>
                                        <td>{{ $supply->id }}</td>
                                        <td>{{ $supply->name }}</td>
                                        <td>{{ ucfirst($supply->category) }}</td>
                                        <td class="text-center">{{ $supply->quantity }}</td>
                                        <td>{{ $supply->unit }}</td>
                                        <td>{{ $supply->building->name ?? 'N/A' }}</td>
                                        <td>
                                            @can('edit supply and equipments')
                                                <a href="{{ route('supply-and-equipments.edit', $supply->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endcan
                                            @can('delete supply and equipments')
                                                <button wire:click="alertConfirm({{ $supply->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No supplies or equipment found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $supplies->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
