<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use App\Helper\CarComparisonManagment;
use App\Models\ElectricCar;
use Jantinnerezo\LivewireAlert\LivewireAlert;

#[Title('جدول مقارنة السيارات')]

class CarComparisonPage extends Component
{
    use LivewireAlert;
    public $comparisonItems = [];

    public function mount()
    {
        $this->loadComparisonItems();
    }

    #[On('carRemovedFromComparison')]
    public function loadComparisonItems()
    {
        $comparisonItemIds = CarComparisonManagment::getComparisonItemsFromCookie();
        $this->comparisonItems = ElectricCar::whereIn('id', $comparisonItemIds)->get();
    }

    public function removeCarFromComparison($carId)
    {
        CarComparisonManagment::removeCarFromComparison($carId);
        $this->loadComparisonItems();
        $this->dispatch('carRemovedFromComparison');
        $this->alert('success', 'تم حذف السيارة من جدول المقارنة');
    }

    public function clearComparisonItems()
    {
        CarComparisonManagment::clearComparisonItemsFromCookie();
        $this->comparisonItems = [];
    }

    public function render()
    {
        return view('livewire.car-comparison-page');
    }
}
