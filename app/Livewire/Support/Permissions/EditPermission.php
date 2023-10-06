<?php

namespace App\Livewire\Support\Permissions;

use App\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditPermission extends Component
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
        return view('livewire.support.permissions.edit-permission');
    }


    #[On('show-edit-permission-form')]
    public function edit(Permission $permission)
    {
        $this->permission = $permission;
        $this->title = $permission->title;
        $this->persian_name = $permission->persian_name;
        $this->description = $permission->description;
    }


    public function update()
    {
        $validated = $this->validate();

        $this->permission->update($validated);

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2500',
            'toast' => false,
            'text' => 'مجوز با موفقیت ویرایش شد',
        ]);

        $this->dispatch('hide-edit-permission-form');
        $this->dispatch('permission-updated');
    }
}
