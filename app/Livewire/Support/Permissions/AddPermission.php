<?php

namespace App\Livewire\Support\Permissions;

use App\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;

class AddPermission extends Component
{
    use LivewireAlert;

    #[Rule('required|min:5|max:120|unique:roles,title')]
    public $title;
    #[Rule('required|min:5|max:120|unique:roles,persian_name')]
    public $persian_name;

    #[Rule('nullable|min:5|max:255')]
    public $description;

    public Permission $permission;

    public function render()
    {
        return view('livewire.support.permissions.add-permission');
    }


    public function store()
    {
        $validated = $this->validate();

        Permission::create($validated);

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2500',
            'toast' => false,
            'text' => 'مجوز جدید با موفقیت ایجاد شد',
        ]);

        $this->dispatch('hide-add-permission-form');
        $this->dispatch('permission-updated');

    }
}
