<?php

namespace App\Livewire\RolesAndPermissions;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public $searchTerm = '';  // Search term

    protected $paginationTheme = 'bootstrap';

    // Resetting pagination when searching
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Filter roles by search term and paginate
        $roles = Role::with('permissions')
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10); // Paginate with 10 per page

        return view('livewire.roles-and-permissions.index', compact('roles'));
    }

    public function delete($roleId)
    {
        $role = Role::findOrFail($roleId);
        $role->delete();

        toastr()->success('Role has been deleted successfully.');
    }
}
