<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\FAQ;
use TomatoPHP\FilamentSettingsHub\Models\Setting;
class FandQ extends Component
{
    #[Title( 'Electric' . ' - الائسئلة الشائعة' )]
    public function render()
    {
        $faqs = FAQ::where('is_active', true)->get();
        return view('livewire.fand-q', compact('faqs'));
    }
}
