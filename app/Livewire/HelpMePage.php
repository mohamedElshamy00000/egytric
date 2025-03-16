<?php

namespace App\Livewire;
use Livewire\Component;
use App\Models\Brand;
use App\Models\Helpme;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Validator;

#[Title('مساعدتي')]
class HelpMePage extends Component
{
    use LivewireAlert;
    #[Url]
    public $name;
    #[Url]
    public $email;
    #[Url]
    public $phone;
    #[Url]
    public $city;
    #[Url]
    public $area;
    #[Url]
    public $useCarToTravel;
    #[Url]
    public $propertyType;
    #[Url]
    public $currentStep = 1;
    #[Url]
    public $selected_brands = [];
    #[Url]
    public $price_range = 10000;
    #[Url]
    public $comment = '';

    // Add a mount method to ensure proper initialization
    // Add these properties after the existing URL properties
    #[Url]
    public $is_quote_request = false;
    #[Url]
    public $car_id;
    #[Url]
    public $is_favorite = false;
    public $quote_requested_at;

    public function mount()
    {
        $this->currentStep = 1;
        $this->quote_requested_at = now();
    }

    public function nextStep()
    {
        // Validate fields based on current step
        if ($this->currentStep == 1) {
            $this->validate([
                'name' => 'required',
                'email' => 'required|email',
                'phone' => 'required',
            ], [
                'name.required' => 'الاسم مطلوب',
                'email.required' => 'البريد الإلكتروني مطلوب',
                'email.email' => 'البريد الإلكتروني غير صالح',
                'phone.required' => 'رقم الهاتف مطلوب',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'city' => 'required',
                'area' => 'required',
            ], [
                'city.required' => 'المدينة مطلوبة',
                'area.required' => 'المنطقة مطلوبة',
            ]);
        } elseif ($this->currentStep == 3) {
            $this->validate([
                'useCarToTravel' => 'required',
                'propertyType' => 'required',
            ], [
                'useCarToTravel.required' => 'يرجى تحديد وسيلة النقل',
                'propertyType.required' => 'نوع العقار مطلوب',
            ]);
        } elseif ($this->currentStep == 4) {
            $this->validate([
                'selected_brands' => 'required|array|min:1',
                'price_range' => 'required',
            ], [
                'selected_brands.required' => 'يرجى اختيار علامة تجارية واحدة على الأقل',
                'selected_brands.min' => 'يرجى اختيار علامة تجارية واحدة على الأقل',
                'price_range.required' => 'نطاق السعر مطلوب',
            ]);
        }

        $this->currentStep = min($this->currentStep + 1, 5);
    }

    public function previousStep()
    {
        $this->currentStep = max($this->currentStep - 1, 1);
    }

    public function submit()
    {
        $this->validate([
            'comment' => 'required',
        ], [
            'comment.required' => 'التعليق مطلوب',
        ]);

        // Create the help request with new fields
        $helpRequest = Helpme::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'city' => $this->city,
            'area' => $this->area,
            'use_car_to_travel' => $this->useCarToTravel,
            'property_type' => $this->propertyType,
            'selected_brands' => $this->selected_brands,
            'price_range' => $this->price_range,
            'comment' => $this->comment,
            'is_quote_request' => $this->is_quote_request,
            'car_id' => $this->car_id,
            'is_favorite' => $this->is_favorite,
            'quote_requested_at' => $this->is_quote_request ? $this->quote_requested_at : null,
        ]);

        // Attach brands
        $helpRequest->brands()->attach($this->selected_brands);

        $this->alert('success', 'تم إرسال الطلب بنجاح');
        $this->reset();
    }

    public function render()
    {
        $brands = Brand::where('is_active', 1)->get();
        return view('livewire.help-me-page', compact('brands'));
    }
}
