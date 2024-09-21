<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $searchTerm = '';  // Search term
    protected $paginationTheme = 'bootstrap';  // Using Bootstrap for pagination

    // Resetting pagination when the search term is updated
    public function updatingSearchTerm()
    {
        $this->resetPage();
    }

    public function render()
    {
        // Filter users by search term and paginate
        $users = User::with('roles')  // Assuming you have roles related to users
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('email', 'like', '%' . $this->searchTerm . '%')
            ->paginate(10);  // Paginate with 10 per page

        return view('livewire.users.index', compact('users'));
    }

    public function delete($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        // Add a success message (e.g., using Toastr or session flash)
        session()->flash('message', 'User has been deleted successfully.');
    }
}
