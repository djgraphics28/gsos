<?php

namespace App\Livewire\Faqs;

use App\Models\Faq;
use Livewire\Component;

class Edit extends Component
{
    public $faqId;
    public $faq;
    public $key;
    public $value;
    public $is_active;

    // Mount method to populate the form with existing FAQ data
    public function mount($faqId)
    {
        $faq = Faq::find($faqId);
        $this->faq = $faq;
        $this->key = $faq->key;
        $this->value = $faq->value;
        $this->is_active = $faq->is_active;
    }

    // Method to update an existing FAQ
    public function updateFaq()
    {
        $this->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string',
            'is_active' => 'boolean',
        ], [
            'key.required' => 'Please type the FAQ question because it\'s required.',
            'value.required' => 'Please type the FAQ answer because it\'s required.',
        ]);

        // Update the FAQ
        $this->faq->update([
            'key' => $this->key,
            'value' => $this->value,
            'is_active' => $this->is_active,
        ]);

        // Flash message for success
        toastr()->success('FAQ has been updated successfully!');

        return redirect()->route('faqs.index');
    }
    public function render()
    {
        return view('livewire.faqs.edit');
    }
}
