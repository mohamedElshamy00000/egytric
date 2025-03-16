<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Helper\CartManagment;
use App\Helper\CarComparisonManagment;

class Header extends Component
{

    public $total_count = 0;
    public $comparisonItems = 1;

    public  $nav_cartItems = [];
    public  $nav_grandTotal = 0;

    public function mount()
    {
        $this->nav_cartItems = CartManagment::getCartItemsFromCookie();
        $this->nav_grandTotal = CartManagment::getCartTotalPrice($this->nav_cartItems);
        $this->total_count = count(CartManagment::getCartItemsFromCookie());

    }


    public function loadComparisonItemsCount()
    {
        $comparisonItemIds = CarComparisonManagment::getComparisonItemsFromCookie();
        $this->comparisonItems = count($comparisonItemIds);
    }

    #[On('cart_updated')]
    public function updatedCartCount($total_items)
    {
        $this->total_count = $total_items;
        $this->nav_cartItems = CartManagment::getCartItemsFromCookie();
        $this->nav_grandTotal = CartManagment::getCartTotalPrice($this->nav_cartItems);
    }
    public function render()
    {
        return view('livewire.partials.header');
    }
}
