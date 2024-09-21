<?php

namespace App\Livewire\Faqs;

use App\Models\Faq;
use Livewire\Component;
use Illuminate\Database\Eloquent\Model;

class Create extends Component
{
    public $key;
    public $value;
    public $is_active = true; // Default value is active

    // Method to create a new FAQ
    public function createFaq()
    {
        // Validation rules
        $this->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:1000',
            'is_active' => 'boolean',
        ], [
            'key.required' => 'The FAQ key is required.',
            'value.required' => 'The FAQ value is required.',
        ]);

        // Create the FAQ
        $faq = Faq::create([
            'key' => $this->key,
            'value' => $this->value,
            'is_active' => $this->is_active,
        ]);

        // Flash message for success
        if ($faq instanceof Model) {
            toastr()->success('New FAQ has been saved successfully!');

            return redirect()->route('faqs.index');
        }

        toastr()->error('An error has occurred, please try again later.');

        return back();
    }
    public function render()
    {
        return view('livewire.faqs.create');
    }
}
