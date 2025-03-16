<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ElectricCar;
use App\Models\FAQ;
use Firefly\FilamentBlog\Models\Post;
use App\Models\Testimonial;
use App\Models\ChargingStation;
use TomatoPHP\FilamentSettingsHub\Models\Setting;

class HomePage extends Component

{
    #[Title( 'Electric' . ' - الرئيسية' )]

    public function render()
    {
        $categories = Category::where('is_active', true)->get();
        $products = Product::where('is_active', true)->take(4)->get();
        $brands = Brand::where('is_active', true)->get();
        $featuredCars = ElectricCar::where('is_featured', true)->get();
        $eCars = ElectricCar::latest()->take(8)->get();
        $posts = Post::latest()->take(3)->get();
        $testimonials = Testimonial::get();
        $faqs = FAQ::where('is_active', true)->get();
        $chargingStations = ChargingStation::get();

        $allsetting = Setting::all();
        // dd($allsetting);
        return view('livewire.home-page', compact('categories', 'products', 'brands', 'featuredCars', 'testimonials', 'posts', 'faqs','eCars','chargingStations','allsetting'));
    }
}
