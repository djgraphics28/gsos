<?php

namespace App\Livewire;

use App\Models\Form;
use Livewire\Component;
use App\Models\Workflow;
use App\Models\FormField;

class DynamicForm extends Component
{
    public $formId;
    public $name;
    public $workflow;
    public $workflows = [];
    public $fields = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'workflow' => 'required',
        'fields.*.label' => 'required|string|max:255',
        'fields.*.type' => 'required|string',
        'fields.*.options' => 'nullable|string',
        'fields.*.placeholder' => 'nullable|string',
        'fields.*.helper_text' => 'nullable|string',
        'fields.*.order' => 'integer',
    ];

    public function mount($formId = null)
    {
        if ($formId) {
            $form = Form::findOrFail($formId);
            $this->formId = $form->id;
            $this->name = $form->name;
            $this->workflow= $form->workflow_id;
            $this->fields = $form->fields->sortBy('order')->values()->toArray();
        }

        //put Title and Description default
        $this->fields[] = [
            'label' => 'Title',
            'type' => 'textbox',
            'options' => '',
            'placeholder' => '',
            'helper_text' => '',
            'order' => 1,
        ];

        //i want to add another which is description
        $this->fields[] = [
            'label' => 'Description',
            'type' => 'textbox',
            'options' => '',
            'placeholder' => '',
            'helper_text' => '',
            'order' => 2,
        ];

        $this->workflows = Workflow::all();
    }

    #[On('reorderFields')]
    public function updateOrder($order)
    {
        $newFields = collect($order)->map(fn ($index) => $this->fields[$index])->toArray();
        $this->fields = $newFields;  // Trigger reactivity in Livewire
        $this->updateFieldOrder();   // Re-assign 'order' values based on new sequence
    }

    public function addField()
    {
        $this->fields[] = [
            'label' => '',
            'type' => 'textbox',
            'options' => '',
            'placeholder' => '',
            'helper_text' => '',
            'order' => count($this->fields) + 1,
        ];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields); // Re-index array
        $this->updateFieldOrder();
    }

    private function updateFieldOrder()
    {
        foreach ($this->fields as $index => &$field) {
            $field['order'] = $index + 1;
        }
        $this->fields = array_values($this->fields);  // Force reactivity
    }

    public function saveForm()
    {
        $this->validate();

        $form = $this->formId ? Form::find($this->formId) : new Form;
        $form->name = $this->name;
        $form->workflow_id = $this->workflow;
        $form->save();

        foreach ($this->fields as $fieldData) {
            $field = isset($fieldData['id']) ? FormField::find($fieldData['id']) : new FormField;
            $field->fill($fieldData);
            $field->form_id = $form->id;
            $field->save();
        }

        session()->flash('message', 'Form saved successfully!');
    }

    public function render()
    {
        return view('livewire.dynamic-form');
    }
}
