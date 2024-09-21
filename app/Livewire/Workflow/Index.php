<?php

namespace App\Livewire\Workflow;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Workflow;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm = '';  // Search term for workflow search
    protected $paginationTheme = 'bootstrap';  // Using Bootstrap for pagination

    protected $listeners = ['delete'];
    public $approveConfirmed;

    // Reset pagination when search term is updated
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Filter workflows by search term and paginate
        $workflows = Workflow::where('name', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);  // Paginate with 10 per page

        return view('livewire.workflow.index', compact('workflows'));
    }

    public function alertConfirm($id)
    {
        $this->approveConfirmed = $id;

        $this->confirm('Are you sure you want to delete this workflow?', [
            'confirmButtonText' => 'Yes, Delete it!',
            'onConfirmed' => 'delete',
        ]);
    }

    public function delete()
    {
        $workflow = Workflow::findOrFail($this->approveConfirmed);
        $workflow->delete();

        // Add a success message (using LivewireAlert or session flash)
        $this->alert('success', 'Workflow has been deleted successfully.');
    }
}
