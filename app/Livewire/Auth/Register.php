<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class Register extends Component
{
    #[Title('انشاء حساب')]

    public $name, $email, $password, $password_confirmation;

    public function register()
    {
        $this->validate(
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]
        );

        try {
            if (str_ends_with($this->email, '@egytric.com')) {
                return redirect()->route('register')->with('error', 'خطا حاول مره اخري');
            }
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
            ]);
            Auth::login($user);
            return redirect()->intended();
        } catch (\Exception $e) {
            return redirect()->route('register')->with('error', 'حدث خطأ ما');
        }
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
