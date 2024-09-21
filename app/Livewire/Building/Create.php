<?php

namespace App\Livewire\Building;

use Livewire\Component;
use App\Models\Building;
use Illuminate\Database\Eloquent\Model;

class Create extends Component
{

    public $name;

    // Method to create a new user
    public function createBuilding()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'Please type building name because it\'s required.',
        ]);

        // Create the building
        $building = Building::create([
            'name' => $this->name,
        ]);

        // Flash message for success
        if ($building instanceof Model) {
            toastr()->success('New Building has been saved successfully!');

            return redirect()->route('buildings.index');
        }

        toastr()->error('An error has occurred please try again later.');

        return back();
    }
    public function render()
    {
        return view('livewire.building.create');
    }
}
