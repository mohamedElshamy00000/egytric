<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
#[Title('طلباتي')]
class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $orders = Order::where('user_id', auth()->user()->id)->paginate(10);
        // dd($orders);
        return view('livewire.my-orders-page', compact('orders'));
    }
}
