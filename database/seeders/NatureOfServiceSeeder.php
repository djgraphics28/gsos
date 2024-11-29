<?php

namespace Database\Seeders;

use App\Models\NatureOfServiceRequest;
use App\Models\NatureOfServicesOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NatureOfServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $nature_of_services = [
            ['name' => 'Electrical'],
            ['name' => 'Plumbing'],
            ['name' => 'Carpentry & Masonry'],
            ['name' => 'Painting'],
        ];

        // Insert Nature of Services
        foreach ($nature_of_services as $service) {
            NatureOfServiceRequest::create($service);
        }

        // Fetch all Nature of Services
        $natureOfServices = NatureOfServiceRequest::all();

        // Loop through each service and add corresponding options
        foreach ($natureOfServices as $service) {
            $options = [];

            if ($service->id == 1) {
                $options = [
                    ['name' => 'Lightings & switches', 'nature_of_service_id' => $service->id],
                    ['name' => 'Outlets', 'nature_of_service_id' => $service->id],
                    ['name' => 'Fans', 'nature_of_service_id' => $service->id],
                    ['name' => 'Aircons', 'nature_of_service_id' => $service->id],
                    ['name' => 'Electrical lines', 'nature_of_service_id' => $service->id],
                ];
            } elseif ($service->id == 2) {
                $options = [
                    ['name' => 'Fixtures', 'nature_of_service_id' => $service->id],
                    ['name' => 'Pipelines', 'nature_of_service_id' => $service->id],
                    ['name' => 'Sanitary Drainage', 'nature_of_service_id' => $service->id],
                    ['name' => 'Water pumps/sources', 'nature_of_service_id' => $service->id],
                    ['name' => 'Open/Closed Canals', 'nature_of_service_id' => $service->id],
                ];
            } elseif ($service->id == 3) {
                $options = [
                    ['name' => 'Furniture', 'nature_of_service_id' => $service->id],
                    ['name' => 'Walls & partitions', 'nature_of_service_id' => $service->id],
                    ['name' => 'Ceilings', 'nature_of_service_id' => $service->id],
                    ['name' => 'Trusses and roofs', 'nature_of_service_id' => $service->id],
                    ['name' => 'Floors and slabs', 'nature_of_service_id' => $service->id],
                ];
            } elseif ($service->id == 4) {
                $options = [
                    ['name' => 'Painting', 'nature_of_service_id' => $service->id],
                    ['name' => 'Termite Proofing', 'nature_of_service_id' => $service->id],
                    ['name' => 'Hauling', 'nature_of_service_id' => $service->id],
                    ['name' => 'Grasscutting/Cleaning', 'nature_of_service_id' => $service->id],
                    ['name' => 'Clearing/Demolition', 'nature_of_service_id' => $service->id],
                ];
            }

            // Insert or update each option
            foreach ($options as $option) {
                NatureOfServicesOption::updateOrCreate(
                    ['name' => $option['name'], 'nature_of_service_id' => $option['nature_of_service_id']],
                    $option
                );
            }
        }
    }
}
