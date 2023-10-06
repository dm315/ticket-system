<?php

namespace App\Livewire\Support\Dashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserDashboard extends Component
{
    public function render()
    {
        return view('livewire.support.dashboard.user-dashboard', [
            'user' => Auth::user(),
        ]);
    }
}
