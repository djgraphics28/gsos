<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Building;
use Illuminate\Validation\Rule;
use App\Models\ServiceRequestForm as RequestForm;
use Illuminate\Support\Facades\Auth;
use App\Models\NatureOfServiceRequest;
use App\Models\NatureOfServicesOption;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ServiceRequestForm extends Component
{
    use LivewireAlert;
    public $requisition_number;
    public $building_id;
    public $service_request_details = [];
    public $service_requestor;
    public $services_to_be_done;
    public $request_message;
    public $remarks;

    public $natureOfServiceRequests;
    public $buildings;

    public $selectedRequest = null; // For the selected Nature of Service Request
    public $selectedOptions = []; // For the selected options
    public $selectedOthers = []; // For tracking the 'Others' selections
    public $othersInput = []; // For the input for the 'Others' option
    public $optionQuantities = []; // For tracking quantities of selected options

    public function mount()
    {
        // Fetch Nature of Service Requests with their options
        $this->natureOfServiceRequests = NatureOfServiceRequest::with('options')->get();
        $this->requisitionNumberGenerator();

        // Fetch available buildings
        $this->buildings = Building::all();
    }

    public function submit()
    {
        // Retrieve the nature of the service request
        $natureOfService = NatureOfServiceRequest::findOrFail($this->selectedRequest);

        // Get selected options with their names
        $selectedOptionNames = NatureOfServicesOption::whereIn('id', $this->selectedOptions)
            ->where('nature_of_service_id', $this->selectedRequest)
            ->pluck('name', 'id')
            ->toArray();

        // Map options with their quantities
        $optionsWithQuantity = collect($this->selectedOptions)->map(function ($optionId) use ($selectedOptionNames) {
            return [
                'name' => $selectedOptionNames[$optionId] ?? 'Unknown Option',
                'quantity' => $this->optionQuantities[$optionId] ?? 1,
            ];
        })->toArray();

        // Prepare service request details
        $this->service_request_details = [
            'nature_of_service_requested' => $natureOfService->name,
            'selected_options' => $optionsWithQuantity,
            'selected_others' => $this->selectedOthers,
            'others_input' => $this->othersInput,
        ];

        // Validate form data
        $this->validate([
            'requisition_number' => 'required|string|max:255',
            'building_id' => 'required|integer',
            'service_request_details' => 'required|array',
        ]);

        // Save the service request form data
        $data = RequestForm::create([
            'requisition_number' => $this->requisition_number,
            'building_id' => $this->building_id,
            'nature_of_service_requested' => $this->selectedRequest,
            'service_request_details' => json_encode($this->service_request_details),
            'service_requestor' => Auth::id(),
            'request_message' => $this->request_message,
        ]);

        if ($data) {
            // Display success alert and reset form fields
            $this->alert('success', 'Service Request Form submitted successfully!');

            return redirect()->route('request-success');
        }
    }

    public function requisitionNumberGenerator()
    {
        // Get the latest requisition number from the database
        $latestRequest = RequestForm::latest()->first();

        if (!$latestRequest) {
            // If no existing requests, start with 0001
            $this->requisition_number = 'REQ-' . date('YmdHis') . '0001';
        } else {
            // Extract the sequence number from the last requisition number
            $lastNumber = substr($latestRequest->requisition_number, -4);
            // Increment the sequence number
            $newNumber = str_pad((int)$lastNumber + 1, 4, '0', STR_PAD_LEFT);
            // Generate new requisition number
            $this->requisition_number = 'REQ-' . date('YmdHis') . $newNumber;
        }
    }
    public function render()
    {
        return view('livewire.service-request-form');
    }
}
