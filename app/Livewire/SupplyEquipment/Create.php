<?php

namespace App\Livewire\SupplyEquipment;

use Livewire\Component;
use App\Models\Building;
use App\Models\SupplyEquipment;
use Illuminate\Database\Eloquent\Model;

class Create extends Component
{
    public $name, $category, $quantity, $unit, $building_id;
    public $buildings; // This will hold a list of buildings

    public function mount()
    {
        $this->buildings = Building::all(); // Load buildings for dropdown
    }

    public function createSupply()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:supply,equipment',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'building_id' => 'required|exists:buildings,id',
        ]);

        $supply = SupplyEquipment::create([
            'name' => $this->name,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'building_id' => $this->building_id,
        ]);

        // Flash message for success
        if ($supply instanceof Model) {
            toastr()->success('New Supply has been saved successfully!');

            return redirect()->route('supply-and-equipments.index');
        }

        toastr()->error('An error has occurred please try again later.');

        return back();
    }
    public function render()
    {
        return view('livewire.supply-equipment.create');
    }
}
