<div>
    @section('title', 'List of FAQs')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('List of FAQs') }}</h1>
        <a href="{{ route('faqs.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create New FAQ
        </a>
    </div>

    <!-- Search Input -->
    <div class="mb-4">
        <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="Search for FAQs...">
    </div>

    <!-- FAQs Table -->
    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('FAQs List') }}</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="faqsTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>{{ __('Question') }}</th>
                                    <th>{{ __('Answer') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($faqs as $faq)
                                    <tr>
                                        <td>{{ $faq->id }}</td>
                                        <td>{{ $faq->key }}</td>
                                        <td>{{ Str::limit($faq->value, 50) }}</td> <!-- Limit the answer for better UX -->
                                        <td>{{ $faq->is_active ? 'Active' : 'Inactive' }}</td>
                                        <td>
                                            <a href="{{ route('faqs.edit', $faq->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <button wire:click="alertConfirm({{ $faq->id }})"
                                                class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No FAQs found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $faqs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
