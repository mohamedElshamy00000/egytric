<?php

namespace App\Livewire\Shop;

use App\Helper\CartManagment;
use Livewire\Component;
use Livewire\Attributes\Title;
use App\Livewire\Partials\Header;
use Livewire\Attributes\On;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Testimonial;
#[Title('السلة - EgyTric')]
class CartPage extends Component
{
    use LivewireAlert;
    public  $cartItems = [];
    public  $grandTotal;

    public function mount()
    {
        $this->cartItems = CartManagment::getCartItemsFromCookie();
        $this->grandTotal = CartManagment::getCartTotalPrice($this->cartItems);
    }

    public function removeFromCart($product_id)
    {
        $this->cartItems = CartManagment::removeProductFromCart($product_id);
        $this->grandTotal = CartManagment::getCartTotalPrice($this->cartItems);
        $this->dispatch('cart_updated', total_items: count($this->cartItems))->to(Header::class);
        $this->alert(
            'success',
            'تم إزالة المنتج من عربة التسوق',
            [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
            ]
        );
    }

    public function decrementQuantity($product_id)
    {
        $this->cartItems = CartManagment::decrementProductQuantity($product_id);
        $this->grandTotal = CartManagment::getCartTotalPrice($this->cartItems);
        $this->dispatch('cart_updated', total_items: count($this->cartItems))->to(Header::class);
    }
    public function incrementQuantity($product_id)
    {
        $this->cartItems = CartManagment::incrementProductQuantity($product_id);
        $this->grandTotal = CartManagment::getCartTotalPrice($this->cartItems);
        $this->dispatch('cart_updated', total_items: count($this->cartItems))->to(Header::class);
    }
    public function render()
    {
        $testimonials = Testimonial::all();
        return view('livewire.shop.cart-page', compact('testimonials'));
    }
}
