<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;

class Login extends Component
{
    #[Title('تسجيل الدخول')]

    public $email, $password, $remember = false;

    public function login()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8',
        ]);
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            return redirect()->intended();
        } else {
            session()->flash('error', 'البريد الإلكتروني أو كلمة المرور غير متطابقين');
            return;
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
