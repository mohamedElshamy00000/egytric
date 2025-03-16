<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use App\Models\User;
use Illuminate\Support\Facades\Password;

#[Title('نسيت كلمة المرور؟')]
class ForgotPassword extends Component
{
    public $email;

    public function save()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(['email' => $this->email]);

        if($status === Password::RESET_LINK_SENT){
            session()->flash('success', 'تم إرسال رابط إعادة تعين كلمة المرور إلى بريدك الإلكتروني');
            $this->reset('email');
        }else{
            session()->flash('error', 'لا يمكن إرسال رابط إعادة تعين كلمة المرور إلى بريدك الإلكتروني');
        }
        // $user = User::where('email', $this->email)->first();
        // $user->sendPasswordResetNotification($user->createToken('password-reset')->plainTextToken);
        // session()->flash('success', 'تم إرسال رابط إعادة تعين كلمة المرور إلى بريدك الإلكتروني');
    }
    public function render()
    {
        return view('livewire.auth.forgot-password');
    }
}
