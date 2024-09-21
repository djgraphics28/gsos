<?php

namespace App\Livewire\Building;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Building;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm = '';  // Search term
    protected $paginationTheme = 'bootstrap';  // Using Bootstrap for pagination

    protected $listeners = ['delete'];
    public $approveConfirmed;

    // Resetting pagination when the search term is updated
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Filter users by search term and paginate
        $buildings = Building::with('users')  // Assuming you have roles related to users
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);  // Paginate with 10 per page

        return view('livewire.building.index', compact('buildings'));
    }

    public function alertConfirm($id)
    {
        $this->approveConfirmed = $id;

        $this->confirm('Are you sure you want to delete this?', [
            'confirmButtonText' => 'Yes Delete it!',
            'onConfirmed' => 'delete',
        ]);
    }

    public function delete()
    {
        $building = Building::findOrFail($this->approveConfirmed);
        $building->delete();

        // Add a success message (e.g., using Toastr or session flash)
        toastr()->success('Building has been deleted successfully.');
    }
}
