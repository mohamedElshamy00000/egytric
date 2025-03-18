<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\ElectricCar;
use App\Helper\CarComparisonManagment;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\CarOrder;
#[Title( 'Electric' . ' - صفحة تفاصيل السيارة' )]

class CarDetailsPage extends Component
{
    use LivewireAlert;
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function addToComparison($car_id)
    {
        $total_items = CarComparisonManagment::addCarToComparison($car_id);
        $this->alert(
            'success',
            'تم إضافة السيارة إلى جدول المقارنة',
            [
                'position' => 'top',
                'timer' => 3000,
                'toast' => true,
            ]
        );

    }
    public function OrderThisCar($car_id, $order_type)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('register');
        }

        $car = ElectricCar::find($car_id);
        if(!$car){
            $this->alert('error', 'السيارة غير موجودة');
            return;
        }

        CarOrder::create([
            'user_id' => auth()->user()->id,
            'order_type' => $order_type,
            'amount' => $car->offer_price ?? $car->msrp,
            'payment_method' => 'cash',
            'payment_status' => 'pending',
            'status' => 'new',
            'currency' => 'EGP',
            'shipping_amount' => 0,
            'shipping_method' => '',
            'note' => '',
            'electric_car_id' => $car_id,
        ]);

        $this->alert('success', 'تم إنشاء الطلب بنجاح');
        return redirect()->route('my-car-orders');
    }

    public function render()
    {

        $car = ElectricCar::where('slug', $this->slug)->first();
        $suggestedCars = ElectricCar::where('slug', '!=', $this->slug)->get();
        return view('livewire.car-details-page', compact('car', 'suggestedCars'));
    }
}
