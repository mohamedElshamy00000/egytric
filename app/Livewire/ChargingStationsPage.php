<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ChargingStation;
use Livewire\Attributes\Title;

#[Title('محطات الشحن')]
class ChargingStationsPage extends Component
{
    public $chargingStations;

    public function render()
    {
        $this->chargingStations = ChargingStation::all();
        return view('livewire.charging-stations-page', [
            'chargingStations' => $this->chargingStations
        ]);
    }
}
