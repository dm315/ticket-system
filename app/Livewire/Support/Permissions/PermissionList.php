<?php

namespace App\Livewire\Support\Permissions;

use App\Models\Permission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionList extends Component
{

    use WithPagination, LivewireAlert;

    public $permissionID;
    public $perPage = 10, $search = '', $status = '', $sortBy = 'created_at', $sortDir = 'DESC';


    public function updatedSearch()
    {
        $this->resetPage();
    }

    #[On('permission-updated')]
    public function render()
    {
        $this->authorize('show-permissions');

        $permissions = Permission::search($this->search)
            ->with('roles')
            ->when($this->status !== '', fn($query) => $query->where('status', $this->status))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);

        return view('livewire.support.permissions.permission-list', [
            'permissions' => $permissions
        ]);
    }


    public function setSorting($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDir = ($this->sortDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDir = 'DESC';
    }


    public function showConfirmDelete($id)
    {
        $this->permissionID = $id;

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
    public function removePermission()
    {
        $this->authorize('delete-permissions');

        Permission::destroy($this->permissionID);
    }


    public function changeStatus(Permission $permission)
    {
        $permission->status = $permission->status == 1 ? 0 : 1;

        $permission->save();
    }
}
