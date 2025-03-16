<?php

namespace App\Livewire;

use App\Models\ContactUs;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use TomatoPHP\FilamentSettingsHub\Models\Setting;

#[Title('تواصل معنا - egytric')]
class ContactUsPage extends Component
{
    use LivewireAlert;

    public $name;
    public $email;
    public $phone;
    public $message;

    public function submitForm()
    {
        $this->validate([
            'name' => 'required',
            'phone' => "required",
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Send
        ContactUs::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'subject' => 'Contact Us',
            'message' => $this->message,
        ]);
        $this->alert('success', 'تم ارسال الطلب بنجاح');

        // Clear form
        $this->name = '';
        $this->email = '';
        $this->message = '';
        $this->phone = '';

    }

    public function render()
    {
        $setting = Setting::where('name', 'site_social')->first();
        $contactData = $setting && is_array($setting->payload) ? collect($setting->payload) : collect([]);

        return view('livewire.contact-us-page', compact('contactData'));
    }
}
