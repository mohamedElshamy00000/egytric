<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Livewire\Attributes\Title;
use Livewire\Attributes\URL;
use App\Helper\CartManagment;
use App\Livewire\Partials\Header;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('المنتجات - Egytric')]
class ShopPage extends Component
{

    use LivewireAlert;
    #[URL]
    public $selected_categories = [];

    #[URL]
    public $selected_brands = [];

    #[URL]
    public $is_featured = false;

    #[URL]
    public $on_sale = false;

    #[URL]
    public $price_range = 3000;

    // add to cart
    public function addToCart($product_id)
    {
        $total_items = CartManagment::addProductToCart($product_id);
        $this->dispatch('cart_updated', total_items: $total_items)->to(Header::class);
        $this->alert(
            'success',
            'تم إضافة المنتج إلى عربة التسوق',
            [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
            ]
        );
    }

    public function render()
    {
        $products = Product::query()->where('is_active', 1);

        if (! empty($this->selected_categories)) {
            $products->whereIn('category_id', $this->selected_categories);
        }
        if (! empty($this->selected_brands)) {
            $products->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->is_featured) {
            $products->where('is_featured', 1);
        }
        if ($this->on_sale) {
            $products->where('on_sale', 1);
        }
        if ($this->price_range > 0) {
            $products->whereBetween('price', [0, $this->price_range]);
        }

        $categories = Category::all();
        $brands = Brand::all();

        return view('livewire.shop.shop-page', [
            'products' => $products->paginate(20),
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
