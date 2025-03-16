<?php

namespace App\Livewire;

use App\Models\ElectricCar;
use App\Models\Brand;
use Livewire\Component;
use Livewire\Attributes\URL;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title(' السيارات الكهربائية - egytric')]
class CarsPage extends Component
{
    use WithPagination;

    #[URL]
    public $selected_brands = [];

    #[URL]
    public $is_featured = false;

    #[URL]
    public $price_range;

    #[URL]
    public $available_now = null;

    #[URL]
    public $range = [];

    #[URL]
    public $model = '';

    #[URL]
    public $year;

    #[URL]
    public $max_speed;

    public $carBodyTypes;
    public $years;
    public $models; // Add this property

    public function mount()
    {
        $this->price_range = ElectricCar::max('msrp') ?? 3000;
        $this->years = ElectricCar::select('year')->distinct()->orderBy('year', 'desc')->pluck('year')->toArray();
        $this->models = ElectricCar::select('model')->distinct()->orderBy('model')->pluck('model')->toArray();
    }

    public function render()
    {
        $products = ElectricCar::query();

        if (! empty($this->selected_brands)) {
            $products->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->is_featured) {
            $products->where('is_featured', 1);
        }

        if ($this->price_range > 0) {
            $products->whereBetween('msrp', [0, $this->price_range]);
        }

        if ($this->available_now) {
            $products->where('is_available', 1);
        } elseif ($this->available_now === '0') {
            $products->where('is_available', 0);
        }

        if ($this->range) {
            $products->where(function($query) {
                foreach ($this->range as $range) {
                    if ($range === '800+') {
                        $query->orWhere('range_km', '>', 800);
                    } else {
                        [$min, $max] = explode('-', $range);
                        $query->orWhereBetween('range_km', [(int)$min, (int)$max]);
                    }
                }
            });
        }

        if ($this->model) {
            $products->where('model', $this->model);  // Changed from LIKE to exact match
        }

        if ($this->year) {
            $products->where('year', $this->year);
        }

        if ($this->max_speed) {
            $products->where('top_speed_kmh', '<=', $this->max_speed);
        }

        $eCars = $products->paginate(9);
        $brands = Brand::where('is_active', 1)->get();
        $this->carBodyTypes = ElectricCar::select('body_type')->distinct()->get()->pluck('body_type')->toArray();
        return view('livewire.cars-page', compact('eCars', 'brands'));
    }
}
