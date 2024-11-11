<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners = [
            ['title' => 'Banner 1', 'description' => 'This is banner 1', 'order' => 1],
            ['title' => 'Banner 2', 'description' => 'This is banner 2', 'order' => 2],
            ['title' => 'Banner 3', 'description' => 'This is banner 3', 'order' => 3],
        ];

        foreach ($banners as $banner) {
            $newBanner = Banner::create($banner);

            // Adding media (image) to the banner using Laravel Media Library
            // $newBanner->addMedia(storage_path('app/public/banners/banner' . $banner['order'] . '.jpg'))
            //     ->preservingOriginal()
            //     ->toMediaCollection('banners');
        }
    }
}
