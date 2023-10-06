<?php

namespace App\Livewire\Support\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddRole extends Component
{

    use LivewireAlert;

    #[Rule('required|min:5|max:120|unique:roles,title', as: 'نام نقش')]
    public $title;
    #[Rule('required|min:5|max:120|unique:roles,persian_name', as: 'نام نقش')]
    public $persian_name;

    #[Rule('nullable|min:5|max:255')]
    public $description;

    #[Rule('required|exists:permissions,id', as: 'مجوز')]
    public $selectedPermissions = [];


    public function render()
    {
        if (Auth::user()->hasRole(['programmer'])) {
            $permissions = Permission::where('status', 1)->get();
        } else {
            $permissions = Permission::where('status', 1)->whereNot('title', 'LIKE', '%permissions%')->get();
        }

        return view('livewire.support.roles.add-role', [
            'permissions' => $permissions
        ]);
    }


    public function store()
    {
        $this->authorize('create-roles');

        $validated = $this->validate();

        DB::transaction(function () use ($validated) {
            $role = Role::create(Arr::except($validated, ['selectedPermissions']));

            $role->permissions()->sync($validated['selectedPermissions']);
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2500',
            'toast' => false,
            'text' => 'نقش جدید با موفقیت ایجاد شد',
        ]);

        $this->dispatch('hide-create-role-form');
        $this->dispatch('roles-updated');
    }
}
