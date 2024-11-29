<?php

namespace App\Livewire\Frontend;

use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Services extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    public $searchTerm;
    public $serviceId;
    public $title;
    public $shortDescription;
    public $fullDescription;
    public $image;
    public $modalOpen = false;

    public function render()
    {
        return view('livewire.frontend.services', [
            'services' => $this->records
        ]);
    }

    public function getRecordsProperty()
    {
        $query = Service::query();

        if ($this->searchTerm) {
            $query->where('title', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('short_description', 'like', '%' . $this->searchTerm . '%');
        }

        return $query->paginate(6);
    }

    public function openModal($id = null)
    {
        $this->resetFields();

        if ($id) {
            $service = Service::findOrFail($id);
            $this->serviceId = $service->id;
            $this->title = $service->title;
            $this->shortDescription = $service->short_description;
            $this->fullDescription = $service->full_description;
        }

        $this->modalOpen = true;
    }

    public function saveService()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'shortDescription' => 'required|string|max:500',
            'fullDescription' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image upload
        ]);

        $service = Service::updateOrCreate(
            ['id' => $this->serviceId],
            [
                'title' => $this->title,
                'short_description' => $this->shortDescription,
                'full_description' => $this->fullDescription,
            ]
        );


        // Handle Image Upload
        if ($this->image) {
            $service->clearMediaCollection('services'); // Clear existing media
            $service->addMedia($this->image->getRealPath())
                    ->toMediaCollection('services'); // Upload new image
        }

        $this->alert('success', $this->serviceId ? 'Service updated successfully.' : 'Service created successfully.');

        $this->resetFields();
        $this->modalOpen = false;
    }

    public function deleteService($id)
    {
        Service::findOrFail($id)->delete();
        $this->alert('success', 'Service deleted successfully.');
    }

    private function resetFields()
    {
        $this->serviceId = null;
        $this->title = '';
        $this->shortDescription = '';
        $this->fullDescription = '';
    }
}
