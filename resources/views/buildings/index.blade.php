@section('title', 'List of Buildings')
<x-app-layout>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('List of Buildings') }}</h1>
        <a href="{{ route('buildings.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Create New
        </a>
    </div>

    <div class="py-12 mb-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Search Input -->
            <div class="mb-4">
                <input type="text" id="search-building" class="form-control" placeholder="Search Buildings...">
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-bordered" id="buildings-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated by AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<!-- Include jQuery and Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch and display buildings
        fetchBuildings();

        // AJAX search
        $('#search-building').on('keyup', function() {
            let query = $(this).val();
            fetchBuildings(query);
        });

        function fetchBuildings(query = '') {
            $.ajax({
                url: "{{ route('buildings.search') }}",
                method: 'GET',
                data: { search: query },
                success: function(response) {
                    let tableBody = '';
                    if (response.buildings.length > 0) {
                        response.buildings.forEach(function(building) {
                            tableBody += `
                                <tr>
                                    <td>${building.id}</td>
                                    <td>${building.name}</td>
                                    <td>${building.status == 1 ? 'Active' : 'Inactive'}</td>
                                    <td>
                                        <a href="/buildings/${building.id}/edit" class="btn btn-sm btn-warning">Edit</a>
                                        <button class="btn btn-sm btn-danger delete-btn" data-id="${building.id}">Delete</button>
                                    </td>
                                </tr>
                            `;
                        });
                    } else {
                        tableBody = '<tr><td colspan="4" class="text-center">No buildings found</td></tr>';
                    }
                    $('#buildings-table tbody').html(tableBody);

                    // Delete button click event
                    $('.delete-btn').on('click', function() {
                        let buildingId = $(this).data('id');
                        deleteBuilding(buildingId);
                    });
                }
            });
        }

        // AJAX function to delete a building
        function deleteBuilding(id) {
            if (confirm('Are you sure you want to delete this building?')) {
                $.ajax({
                    url: `/buildings/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: "{{ csrf_token() }}" // Include CSRF token for security
                    },
                    success: function(response) {
                        alert('Building deleted successfully!');
                        fetchBuildings(); // Refresh the table after deletion
                    },
                    error: function(error) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        }
    });
</script>
