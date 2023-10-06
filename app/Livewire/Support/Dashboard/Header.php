<?php

namespace App\Livewire\Support\Dashboard;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    use LivewireAlert;

    public function render()
    {
        return view('livewire.support.dashboard.header', [
            'user' => Auth::user(),
        ]);
    }


    public function showConfirmLogout()
    {
        $this->alert('question', 'آیا از انجام عملیات مطمئن هستید؟', [
            'position' => 'center',
            'toast' => false,
            'timer' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'خروج از حساب کاربری',
            'showCancelButton' => true,
            'reverseButtons' => true,
            'cancelButtonText' => 'خیر, دستم خورد',
        ]);
    }

    #[On('confirmed')]
    public function logout()
    {
        Auth::logout();

        $this->redirectRoute('auth.login');
    }
}
