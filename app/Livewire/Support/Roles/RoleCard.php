<?php

namespace App\Livewire\Support\Roles;

use App\Models\Role;
use Livewire\Attributes\On;
use Livewire\Component;

class RoleCard extends Component
{

    public Role $role;

    #[On('roles-updated')]
    public function render()
    {
        return view('livewire.support.roles.role-card');
    }


    public function changeStatus()
    {
        $this->role->status = $this->role->status === 1 ? 0 : 1;
        $this->role->save();
    }

}
