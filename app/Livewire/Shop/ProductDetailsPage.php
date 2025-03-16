<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use App\Helper\CartManagment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Partials\Header;

#[Title('صفحة تفاصيل المنتج - Egytric')]
class ProductDetailsPage extends Component
{
    use LivewireAlert;
    use WithPagination;
    public $slug;
    public $quantity = 1;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    public function incrementQuantity()
    {
        $this->quantity++;
    }


    // add to cart
    public function addToCart($product_id)
    {
        $total_items = CartManagment::addProductToCartFromDetailsPage($product_id, $this->quantity);
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
        $product = Product::where('slug', $this->slug)->where('is_active', 1)->first();
        if (!$product) {
            return abort(404);
        }
        return view('livewire.shop.product-details-page', compact('product'));
    }
}
