<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;

class BrandsPage extends Component
{
    public function mount()
    {
        //
    }
    public function render()
    {
        // brands
        $brands = Brand::where('is_active', '1')->get();
        return view('livewire.brands-page', [
            'brands' => $brands,
        ]);
    }
}
