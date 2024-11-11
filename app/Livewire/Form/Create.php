<?php

namespace App\Livewire\Form;

use App\Models\Form;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use App\Models\Workflow;
use App\Models\FormField;

class Create extends Component
{
    use LivewireAlert;
    public $workflow_id;
    public $form_name;
    public $fields = [];
    public $workflows;
    protected $listeners = ['removeField'];

    public function mount()
    {
        $this->workflows = Workflow::all();
        $this->fields = [
            [
                'label' => 'First Field',
                'placeholder' => '',
                'helper_text' => '',
                'type' => 'text',
                'order' => 1,
                'required' => false,
                'options' => []
            ]
        ]; // Initial field
    }

    public function addField()
    {
        $this->fields[] = [
            'label' => 'New Field', // Default label
            'placeholder' => '',    // Default placeholder
            'helper_text' => '',    // Default helper text
            'type' => 'text',       // Default type
            'options' => [],        // Options for select, radio, etc.
            'order' => count($this->fields) + 1, // Order in form
            'required' => false,    // Default required status
        ];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields); // Re-index array to prevent gaps
    }

    // Save form and fields
    public function save()
    {
        try {

            // dd($this->fields);

            $this->validate([
                'workflow_id' => 'required',
                'form_name' => 'required|string|max:255',
                'fields.*.label' => 'required|string|max:255',
                'fields.*.placeholder' => 'nullable|string|max:255',
                'fields.*.helper_text' => 'nullable|string|max:255',
                'fields.*.type' => 'required|string',
                'fields.*.options' => 'nullable|array',
                'fields.*.order' => 'required|integer',
                'fields.*.required' => 'boolean',
            ]);

            $form = Form::create([
                'workflow_id' => $this->workflow_id,
                'name' => $this->form_name,
            ]);

            foreach ($this->fields as $field) {
                FormField::create([
                    'form_id' => $form->id,
                    'label' => $field['label'],
                    'placeholder' => $field['placeholder'],
                    'helper_text' => $field['helper_text'],
                    'type' => $field['type'],
                    'options' => $field['options'],
                    'order' => $field['order'],
                    'required' => $field['required'] ? true : false,
                ]);
            }

            $this->alert('success', 'Form created successfully.');
            return redirect()->route('forms.index');

        } catch (\Exception $e) {
            $this->alert('error', 'An error occurred: ' . $e->getMessage());
        }
    }



    public function render()
    {
        return view('livewire.form.create');
    }
}
