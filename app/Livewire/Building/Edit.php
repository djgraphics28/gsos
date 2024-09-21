<?php

namespace App\Livewire\Building;

use Livewire\Component;
use App\Models\Building;
use Illuminate\Database\Eloquent\Model;

class Edit extends Component
{
    public $building;
    public $name;

    // Mount method to populate the form with existing building data
    public function mount(Building $building)
    {
        $this->building = $building;
        $this->name = $building->name;
    }

    // Method to update an existing building
    public function updateBuilding()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Please type the building name because it\'s required.',
        ]);

        // Update the building
        $this->building->update([
            'name' => $this->name,
        ]);

        // Flash message for success
        toastr()->success('Building has been updated successfully!');

        return redirect()->route('buildings.index');
    }

    public function render()
    {
        return view('livewire.building.edit', [
            'building' => $this->building,
        ]);
    }
}
