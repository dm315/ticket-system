<?php

namespace App\Livewire\Support\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.support.dashboard.index');
    }
}
