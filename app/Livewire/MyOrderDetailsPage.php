<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Livewire\Attributes\Title;
use App\Models\OrderItem;
use App\Models\Address;

#[Title('تفاصيل الطلب')]

class MyOrderDetailsPage extends Component
{
    public $orderId;

    public function mount($orderId)
    {
        $this->orderId = $orderId;
    }

    public function render()
    {
        $orderItems = OrderItem::with('product')->where('order_id', $this->orderId)->get();
        $address = Address::where('order_id', $this->orderId)->first();
        $order = Order::where('id', $this->orderId)->where('user_id', auth()->user()->id)->first();
        if (!$order || $order->user_id != auth()->user()->id) {
            return abort(404);
        }
        return view('livewire.my-order-details-page', compact('orderItems', 'address', 'order'));
    }
}
