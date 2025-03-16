<?php

namespace App\Livewire\Shop;

use Livewire\Component;
use App\Helper\CartManagment;
use App\Livewire\Partials\Header;
use App\Models\Order;
use Livewire\Attributes\Title;
use App\Models\Address;
use MG\Paymob\Paymob;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;

#[Title('الدفع - Egytric')]
class Checkout extends Component
{
    public  $first_name,
            $last_name,
            $country,
            $address,
            $city,
            $state,
            $postal_code,
            $email,
            $phone,
            $notes,
            $payment_method = 'cashOnDelivery';

    public function mount()
    {
        $cartItems = CartManagment::getCartItemsFromCookie();
        if(count($cartItems) == 0) {
            return redirect()->route('shop');
        }
    }
    public function placeOrder()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'country' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'phone' => 'required',
            'notes' => 'nullable',
            'payment_method' => 'required',
        ]);
        $cartItems = CartManagment::getCartItemsFromCookie();
        $lineItems = [];
        foreach ($cartItems as $item) {
            $lineItems[] = [
                'name' => $item['name'],
                'quantity' => $item['quantity'],
                'amount_cents' => $item['price'],
                'description' => $item['name'],
                'quantity' => $item['quantity'],
            ];
        }
        $billingData = [
            'first_name'      => $this->first_name,
            'last_name'       => $this->last_name,
            'email'           => auth()->user()->email,
            'phone_number'    => $this->phone,
            'apartment'       => 'N/A',
            'floor'           => 'N/A',
            'building'        => 'N/A',
            'street'          => $this->address,
            'city'            => $this->city,
            'shipping_method' => 'N/A',
            'country'         => $this->country,
            'state'           => $this->state,

        ];

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagment::getCartTotalPrice($cartItems);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->currency = 'EGP';
        $order->shipping_amount = 0;
        $order->shipping_method = 'none';
        $order->note = $this->notes;
        $order->save();

        $address = new Address();
        $address->user_id = auth()->user()->id;
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->country = $this->country;
        $address->street = $this->address;
        $address->phone = $this->phone;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->postal_code = $this->postal_code;
        // $address->save();

        $redirectRoute = '';

        if($this->payment_method === 'cashOnDelivery') {
            // cashOnDelivery
            $redirectRoute = route('success');

        } elseif ($this->payment_method == 'creditCard') {

            // Prepare order itself
            $orderToPrepare['amount_cents']      = $order->grand_total * 100;
            $orderToPrepare['merchant_order_id'] = $order->id;
            $orderToPrepare['items']             = $lineItems;
            $orderToPrepare['billing_data']      = $billingData;

            // Initialize Paymob
            $paymob = new Paymob();
            try {
                $paymentUrl = $paymob->makePayment($orderToPrepare);
                $redirectRoute = $paymentUrl;

            } catch (\Exception $e) {
                // Handle the error (e.g., log it, show a message to the user)
                session()->flash('error', 'Payment failed: ');
                return redirect()->route('checkout'); // Redirect back to the checkout page
            }
        }
        $order->save();
        $address->order_id = $order->id;
        $address->save();

        foreach ($cartItems as $item) {
            // dd($item);
            $order->items()->create([
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'unit_amount' => $item['unit_amount'],
                'total_amount' => $item['unit_amount'] * $item['quantity'],
            ]);
        }
        CartManagment::clearCartItemsFromCookie();
        Mail::to(request()->user()->email)->send(new OrderPlaced($order));
        $this->dispatch('cart_updated', total_items: count($cartItems))->to(Header::class);
        return redirect($redirectRoute);

    }
    public function render()
    {
        $cartItems = CartManagment::getCartItemsFromCookie();
        $grandTotal = CartManagment::getCartTotalPrice($cartItems);
        return view('livewire.shop.checkout', compact('cartItems', 'grandTotal'));
    }
}
