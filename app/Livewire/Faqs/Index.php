<?php

namespace App\Livewire\Faqs;

use App\Models\Faq;
use Livewire\Component;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Index extends Component
{
    use WithPagination, LivewireAlert;

    public $searchTerm = '';  // Search term for FAQ
    protected $paginationTheme = 'bootstrap';  // Using Bootstrap for pagination
    public $approveConfirmed; // Store ID for deletion confirmation

    protected $listeners = ['delete'];

    // Resetting pagination when the search term is updated
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Filter FAQs by search term and paginate
        $faqs = Faq::where('key', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('value', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);  // Paginate with 10 per page

        return view('livewire.faqs.index', compact('faqs'));
    }

    public function alertConfirm($id)
    {
        $this->approveConfirmed = $id;

        $this->confirm('Are you sure you want to delete this FAQ?', [
            'confirmButtonText' => 'Yes, delete it!',
            'onConfirmed' => 'delete',
        ]);
    }

    public function delete()
    {
        $faq = Faq::findOrFail($this->approveConfirmed);
        $faq->delete();

        // Success message after deletion
        $this->alert('success', 'FAQ has been deleted successfully.');
    }
}
