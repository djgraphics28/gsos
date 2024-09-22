<div>
    @section('title', 'List of Workflows')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('List of Workflows') }}</h1>
        @can('create workflows')
            <a href="{{ route('workflows.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Create New
            </a>
        @endcan
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Search for workflows...">
    </div>

    <!-- Workflows Table -->
    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('Workflows List') }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="workflowsTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($workflows as $workflow)
                                    <tr>
                                        <td>{{ $workflow->id }}</td>
                                        <td>{{ $workflow->name }}</td>
                                        <td>
                                            @can('edit workflows')
                                                <a href="{{ route('workflows.edit', $workflow->id) }}"
                                                    class="btn btn-sm btn-warning">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            @endcan
                                            @can('delete workflows')
                                                <button wire:click="alertConfirm({{ $workflow->id }})"
                                                    class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No workflows found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $workflows->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
