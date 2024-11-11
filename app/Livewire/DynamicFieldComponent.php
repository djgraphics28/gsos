<?php

namespace App\Livewire;

use Livewire\Component;

class DynamicFieldComponent extends Component
{
    public $field;
    public $index;

    public function mount($field, $index)
    {
        $this->field = $field;
        $this->index = $index;
    }

    public function addOption()
    {
        $this->field['options'][] = ''; // Add an empty option
    }

    public function removeOption($optionIndex)
    {
        unset($this->field['options'][$optionIndex]); // Remove selected option
        $this->field['options'] = array_values($this->field['options']); // Re-index array
    }

     // Emit event to the parent component to remove this field
     public function removeField()
     {
         $this->dispatch('removeField', $this->index);
     }

    public function render()
    {
        return view('livewire.dynamic-field-component');
    }
}
