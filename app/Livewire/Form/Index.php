<?php

namespace App\Livewire\Form;

use App\Models\Form;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm = '';  // Search term for form search
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
        // Filter forms by search term and paginate
        $forms = Form::where('name', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);  // Paginate with 10 per page

        return view('livewire.form.index', compact('forms'));
    }

    public function alertConfirm($id)
    {
        $this->approveConfirmed = $id;

        $this->confirm('Are you sure you want to delete this form?', [
            'confirmButtonText' => 'Yes, Delete it!',
            'onConfirmed' => 'delete',
        ]);
    }

    public function delete()
    {
        $form = Form::findOrFail($this->approveConfirmed);
        $form->delete();

        // Add a success message (using LivewireAlert or session flash)
        $this->alert('success', 'Form has been deleted successfully.');
    }
}
