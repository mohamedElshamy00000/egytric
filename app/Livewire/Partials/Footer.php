<?php

namespace App\Livewire\Partials;

use Livewire\Component;
use TomatoPHP\FilamentSettingsHub\Models\Setting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Footer extends Component
{
    public $phone;
    public $successMessage = false;
    public $errorMessage = '';

    protected $rules = [
        'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
    ];

    protected $messages = [
        'phone.required' => 'الرجاء إدخال رقم الهاتف',
        'phone.regex' => 'الرجاء إدخال رقم هاتف صحيح',
        'phone.min' => 'الرجاء إدخال رقم هاتف صحيح (10 أرقام على الأقل)',
    ];

    public function subscribe()
    {
        $this->validate();

        // try {
            // Check if phone already exists
            $exists = DB::table('fblog_news_letters')->where('phone', $this->phone)->exists();

            if ($exists) {
                $this->errorMessage = 'رقم الهاتف مسجل مسبقاً';
                return;
            }

            // Add the phone number to the newsletter table
            DB::table('fblog_news_letters')->insert([
                'email' => $this->phone,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->reset('phone');
            $this->successMessage = true;
            $this->errorMessage = '';
        // } catch (\Exception $e) {
        //     $this->errorMessage = 'حدث خطأ. الرجاء المحاولة مرة أخرى.';
        // }
    }

    public function render()
    {
        $setting = Setting::where('name', 'site_social')->first();
        $socials = $setting && is_array($setting->payload) ? collect($setting->payload) : collect([]);
        return view('livewire.partials.footer', compact('socials'));
    }
}
