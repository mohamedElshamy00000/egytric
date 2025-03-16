<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Http\Request; // Import the Request class
use App\Models\Order; // Import the Order model


#[Title('Egytric - Callback')]
class CallbackPage extends Component
{
    public function mount(Request $request) // Add mount method to handle the request
    {
        $this->handlePaymentRequest($request);
    }

    private function handlePaymentRequest(Request $request) // New method to process the payment request
    {
        // Extract parameters from the request
        $id = $request->query('id'); // Payment ID
        $success = $request->query('success'); // Payment success status
        $amountCents = $request->query('amount_cents'); // Amount in cents
        $merchantOrderId = $request->query('merchant_order_id'); // Merchant order ID
        // dd($merchantOrderId);
        // Find the order using the merchant order ID
        $order = Order::where('id', $merchantOrderId)->first(); // Assuming you have an Order model

        // Process the payment based on the success status
        if ($success === 'true') {
            // Handle successful payment
            if ($order) {
                $order->payment_status = 'paid'; // Update order status
                $order->save(); // Save changes to the database
            }
            return redirect()->route('success');

        } else {
            // Handle failed payment
            if ($order) {
                $order->payment_status = 'failed'; // Update order status
                $order->save(); // Save changes to the database
            }
            return redirect()->route('failed');
            // Optionally, you can log the error or notify the user
        }
    }

    public function render()
    {
        return view('livewire.callback-page');
    }
}
