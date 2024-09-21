<?php

namespace App\Livewire\Workflow;

use Livewire\Component;
use App\Models\Workflow;
use Illuminate\Database\Eloquent\Model;

class Edit extends Component
{
    public $workflow;
    public $name;

    // Mount method to populate the form with existing workflow data
    public function mount(Workflow $workflow)
    {
        $this->workflow = $workflow;
        $this->name = $workflow->name;
    }

    // Method to update an existing workflow
    public function updateWorkflow()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Please type the workflow name because it\'s required.',
        ]);

        // Update the workflow
        $this->workflow->update([
            'name' => $this->name,
        ]);

        // Flash message for success
        toastr()->success('Workflow has been updated successfully!');

        return redirect()->route('workflows.index');
    }

    public function render()
    {
        return view('livewire.workflow.edit', [
            'workflow' => $this->workflow,
        ]);
    }
}
