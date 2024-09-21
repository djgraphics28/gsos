<?php

namespace App\Livewire\SupplyEquipment;

use App\Models\SupplyEquipment;
use Livewire\Component;
use App\Models\Building;

class Edit extends Component
{
    public $name, $category, $quantity, $unit, $building_id;
    public $supplyId; // This holds the supply ID being edited
    public $buildings = []; // This will hold the list of buildings

    public function mount($supplyId)
    {
        $supply = SupplyEquipment::find($supplyId);
        $this->supplyId = $supply->id;
        $this->name = $supply->name;
        $this->category = $supply->category;
        $this->quantity = $supply->quantity;
        $this->unit = $supply->unit;
        $this->building_id = $supply->building_id;

        $this->buildings = Building::all(); // Load buildings for dropdown
    }

    public function updateSupply()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|in:supply,equipment',
            'quantity' => 'required|integer|min:1',
            'unit' => 'required|string|max:50',
            'building_id' => 'required|exists:buildings,id',
        ]);

        $supply = SupplyEquipment::findOrFail($this->supplyId);
        $supply->update([
            'name' => $this->name,
            'category' => $this->category,
            'quantity' => $this->quantity,
            'unit' => $this->unit,
            'building_id' => $this->building_id,
        ]);

        if ($supply) {
            toastr()->success('Supply & Equipment has been updated successfully!');

            return redirect()->route('supply-and-equipments.index');
        }

        toastr()->error('An error has occurred, please try again later.');
        return back();
    }

    public function render()
    {
        return view('livewire.supply-equipment.edit', [
            'buildings' => $this->buildings, // Pass buildings to the view
        ]);
    }
}
