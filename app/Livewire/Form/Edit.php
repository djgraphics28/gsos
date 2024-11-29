<?php

namespace App\Livewire\Form;

use App\Models\Form;
use Livewire\Component;
use App\Models\Workflow;
use App\Models\FormField;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Edit extends Component
{
    use LivewireAlert;

    public $form_id;
    public $workflow_id;
    public $form_name;
    public $fields = [];
    public $workflows;
    public $form; // Add this property to hold the form object

    public function mount($form_id)
    {
        $this->form_id = $form_id;
        $this->workflows = Workflow::all();

        // Load form and its fields
        $this->form = Form::findOrFail($form_id); // Assign form to the class property
        $this->workflow_id = $this->form->workflow_id;
        $this->form_name = $this->form->name;

        // Load fields
        $this->fields = $this->form->fields->map(function ($field) {
            return [
                'id' => $field->id, // Ensure 'id' is included for updates
                'label' => $field->label,
                'placeholder' => $field->placeholder,
                'helper_text' => $field->helper_text,
                'type' => $field->type,
                'order' => $field->order,
                'required' => $field->required,
                'options' => is_array($field->options) ? $field->options : [], // Ensure it's an array
            ];
        })->toArray();
    }

    public function addField()
    {
        $this->fields[] = [
            'label' => 'New Field',
            'placeholder' => '',
            'helper_text' => '',
            'type' => 'text',
            'options' => [],
            'order' => count($this->fields) + 1,
            'required' => false,
        ];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields); // Re-index array to prevent gaps
    }

    public function update()
    {
        try {
            $this->validate([
                'workflow_id' => 'required',
                'form_name' => 'required|string|max:255',
                'fields.*.label' => 'required|string|max:255',
                'fields.*.placeholder' => 'nullable|string|max:255',
                'fields.*.helper_text' => 'nullable|string|max:255',
                'fields.*.order' => 'required|integer',
                'fields.*.type' => 'required|string',
                'fields.*.options' => 'nullable|array',  // Validation for options
                'fields.*.options.*' => 'nullable|string|max:255',  // Ensure options are valid strings
            ]);

            // Update the form
            $form = Form::findOrFail($this->form_id);
            $form->update([
                'workflow_id' => $this->workflow_id,
                'name' => $this->form_name,
            ]);

            // Delete old fields (if any)
            $existingFieldIds = array_column($this->fields, 'id');
            FormField::where('form_id', $form->id)
                ->whereNotIn('id', $existingFieldIds)
                ->delete();

            // Create or update fields
            foreach ($this->fields as $fieldData) {
                // If 'id' exists, update the existing field
                if (isset($fieldData['id'])) {
                    $field = FormField::find($fieldData['id']);

                    // Only update if the field exists
                    if ($field) {
                        $field->update([
                            'label' => $fieldData['label'],
                            'placeholder' => $fieldData['placeholder'],
                            'helper_text' => $fieldData['helper_text'],
                            'type' => $fieldData['type'],
                            'order' => $fieldData['order'],
                            'required' => $fieldData['required'],
                            'options' => $fieldData['options'],
                        ]);
                    }
                } else {
                    // If 'id' doesn't exist, create a new field
                    FormField::create([
                        'form_id' => $form->id,
                        'label' => $fieldData['label'],
                        'placeholder' => $fieldData['placeholder'],
                        'helper_text' => $fieldData['helper_text'],
                        'type' => $fieldData['type'],
                        'order' => $fieldData['order'],
                        'required' => $fieldData['required'],
                        'options' => $fieldData['options'],
                    ]);
                }
            }

            $this->alert('success', 'Form updated successfully!');
            return redirect()->route('forms.index');
        } catch (\Exception $e) {
            \Log::error('Form update error: ' . $e->getMessage()); // Log the error for debugging
            $this->alert('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.form.edit');
    }
}
