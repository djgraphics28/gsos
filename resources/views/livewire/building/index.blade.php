<div>
    @section('title', 'List of Buildings')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('List of Buildings') }}</h1>
        <a href="{{ route('buildings.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> Create New</a>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

        </div>
    </div>
</div>
