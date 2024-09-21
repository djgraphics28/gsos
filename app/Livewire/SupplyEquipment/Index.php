<?php

namespace App\Livewire\SupplyEquipment;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SupplyEquipment;
use Jantinnerezo\LivewireAlert\LivewireAlert;

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
        // Filter supplies by search term and paginate
        $supplies = SupplyEquipment::with('building')  // Assuming there's a relation to buildings
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('category', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);  // Paginate with 10 per page

        return view('livewire.supply-equipment.index', compact('supplies'));
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
        $supply = SupplyEquipment::findOrFail($this->approveConfirmed);
        $supply->delete();

        // Add a success message
        toastr()->success('Supply & Equipment has been deleted successfully.');
    }
}
