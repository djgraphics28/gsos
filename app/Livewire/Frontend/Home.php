<?php

namespace App\Livewire\Frontend;

use App\Models\Banner;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Home extends Component
{
    use WithFileUploads, LivewireAlert;

    public $banners = [];
    public $newImages = [];

    public function mount()
    {
        // Load banners as an array and include image URL from the media library
        $this->banners = Banner::with('media')->orderBy('order')->get()->map(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $banner->title,
                'description' => $banner->description,
                'image' => $banner->getFirstMediaUrl('banners') ?? null,  // Get the media URL
                'order' => $banner->order,
            ];
        })->toArray();
    }

    // Update the banner order after drag-and-drop
    public function updateBannerOrder($order)
    {
        foreach ($order as $item) {
            Banner::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        // Refresh banners after reordering
        $this->refreshBanners();
        $this->emit('bannersUpdated');
    }

    // Save changes to banner titles, descriptions, and images
    public function saveChanges()
    {
        foreach ($this->banners as $bannerData) {
            $banner = Banner::find($bannerData['id']);
            $banner->update([
                'title' => $bannerData['title'],
                'description' => $bannerData['description'],
            ]);

            // If a new image is uploaded, replace the old image
            if (isset($this->newImages[$bannerData['id']])) {
                $banner->clearMediaCollection('banners');
                $banner->addMedia($this->newImages[$bannerData['id']]->getRealPath())
                       ->toMediaCollection('banners');
            }
        }

        // Reload the banners after saving changes
        $this->refreshBanners();
        // session()->flash('message', 'Banners updated successfully.');
        $this->alert('success', 'Banners updated successfully.');
    }

    // Remove image from a banner
    public function removeImage($bannerId)
    {
        $banner = Banner::find($bannerId);
        if ($banner) {
            $banner->clearMediaCollection('banners'); // Remove image from media library
        }

        $this->refreshBanners();
        $this->alert('success', 'Image removed successfully.');
    }

    // Refresh banners list
    private function refreshBanners()
    {
        $this->banners = Banner::with('media')->orderBy('order')->get()->map(function ($banner) {
            return [
                'id' => $banner->id,
                'title' => $banner->title,
                'description' => $banner->description,
                'image' => $banner->getFirstMediaUrl('banners') ?? null,
                'order' => $banner->order,
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.frontend.home');
    }
}
