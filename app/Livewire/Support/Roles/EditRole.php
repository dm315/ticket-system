<?php

namespace App\Livewire\Support\Roles;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;

class EditRole extends Component
{

    use LivewireAlert;


    public $title;
    public $persian_name;

    #[Rule('nullable|min:5|max:255')]
    public $description;

    #[Rule('required|exists:permissions,id', as: 'مجوز', onUpdate: false)]
    public $selectedPermissions = [];

    public Role $role;


    public function rules()
    {
        return [
            'title' => 'required|min:5|max:120|unique:roles,title,' . $this->role->id,
            'persian_name' => 'required|min:5|max:120|unique:roles,persian_name,' . $this->role->id,
        ];
    }


    public function render()
    {
        if (Auth::user()->hasRole(['programmer'])) {
            $permissions = Permission::where('status', 1)->get();
        } else {
            $permissions = Permission::where('status', 1)->whereNot('title', 'LIKE', '%permissions%')->get();
        }


        return view('livewire.support.roles.edit-role', [
            'permissions' => $permissions
        ])->title('نقش ها');
    }


    #[On('show-edit-role-modal')]
    public function edit(Role $role)
    {
        $this->role = $role;
        $this->title = $role->title;
        $this->persian_name = $role->persian_name;
        $this->description = $role->description;
        $this->selectedPermissions = $role->permissions()->pluck('id')->toArray() ?? [];
    }


    public function update()
    {
        $this->authorize('update-roles');


        $validated = $this->validate();


        DB::transaction(function () use ($validated) {
            $this->role->update(Arr::except($validated, ['selectedPermissions']));

            $this->role->permissions()->sync($validated['selectedPermissions']);
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2500',
            'toast' => false,
            'text' => 'نقش با موفقیت ویرایش شد',
        ]);

        $this->dispatch('hide-edit-role-modal');
        $this->dispatch('roles-updated');
    }
}
