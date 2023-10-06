<?php

namespace App\Livewire\Support\Roles;

use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;


class RolesList extends Component
{

    use LivewireAlert;


    public $roleID, $perPage = 6;


    public function loadMore()
    {
        $this->perPage += 6;
    }

    #[On('roles-updated')]
    public function render()
    {

        $this->authorize('show-roles');

        if (Auth::user()->hasRole(['programmer'])) {
            $roles = Role::with('users')->limit($this->perPage)->get();
        } else {
            $roles = Role::with('users')->whereNot('title', 'programmer')->limit($this->perPage)->get();
        }
        return view('livewire.support.roles.roles-list', [
            'roles' => $roles,
        ]);
    }


    public function showConfirmDelete(int $id)
    {
        $this->roleID = $id;

        $this->alert('question', 'آیا از انجام عملیات مطمئن هستید؟', [
            'position' => 'center',
            'toast' => false,
            'timer' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'حذف کنید',
            'showCancelButton' => true,
            'reverseButtons' => true,
            'cancelButtonText' => 'خیر, دستم خورد',
        ]);
    }

    #[On('confirmed')]
    public function removeRole()
    {
        $this->authorize('delete-roles');

        Role::destroy($this->roleID);

        $this->reset('roleID');

    }
}
