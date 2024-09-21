<?php

namespace App\Livewire\Workflow;

use Livewire\Component;
use App\Models\Workflow;
use Illuminate\Database\Eloquent\Model;

class Create extends Component
{
    public $name;

    // Method to create a new workflow
    public function createWorkflow()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Please type workflow name because it\'s required.',
        ]);

        // Create the workflow
        $workflow = Workflow::create([
            'name' => $this->name,
        ]);

        // Flash message for success
        if ($workflow instanceof Model) {
            toastr()->success('New Workflow has been saved successfully!');

            return redirect()->route('workflows.index');
        }

        toastr()->error('An error has occurred, please try again later.');

        return back();
    }

    public function render()
    {
        return view('livewire.workflow.create');
    }
}
