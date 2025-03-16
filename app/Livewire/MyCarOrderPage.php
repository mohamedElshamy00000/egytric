<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CarOrder;
class MyCarOrderPage extends Component
{
    public function render()
    {
        $orders = CarOrder::where('user_id', auth()->user()->id)->paginate(10);
        return view('livewire.my-car-order-page', compact('orders'));
    }
}
