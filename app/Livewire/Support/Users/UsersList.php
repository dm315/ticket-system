<?php

namespace App\Livewire\Support\Users;

use App\Http\Services\Image\ImageService;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class UsersList extends Component
{
    use LivewireAlert, WithPagination;

    public $userId;
    public $perPage = 10, $search = '', $user_type = '', $sortBy = 'created_at', $sortDir = 'DESC';

    public $removedUsers = [];


    public function updatedSearch()
    {
        $this->resetPage();
    }


    public function render()
    {
        $this->authorize('show-user');

        $users = User::search($this->search)
            ->when($this->user_type !== '', fn($query) => $query->where('user_type', $this->user_type))
            ->orderBy($this->sortBy, $this->sortDir)
            ->paginate($this->perPage);


        return view('livewire.support.users.users-list', [
            'users' => $users,
        ])->title('لیست کاربران');
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


    public function changeStatus(User $user, $user_type)
    {
        $this->authorize('update-user');

        $user_type = $user_type == 0 ? 1 : 0;
        $user->update(['user_type' => $user_type]);
    }

    public function showConfirmDelete($id)
    {
        $this->userId = $id;

        $this->alert('question', 'آیا از انجام عملیات مطمئن هستید؟', [
            'position' => 'center',
            'toast' => false,
            'timer' => '',
            'showConfirmButton' => true,
            'onConfirmed' => 'confirmed',
            'confirmButtonText' => 'حذف کنید',
            'showCancelButton' => true,
            'reverseButtons' => true,
            'onDismissed' => '',
            'cancelButtonText' => 'خیر, دستم خورد',
        ]);
    }

    #[On('confirmed')]
    public function removeUser()
    {
        if (Auth::user()->user_type == 0 && $this->userId != Auth::user()->id) {
            abort(403);
        }

        User::destroy($this->userId);
    }


    public function recycleBin()
    {
        $this->removedUsers = User::onlyTrashed()->get();

        $this->dispatch('show-recycleBin');
    }

    public function forceDelete(int $id, ImageService $imageService)
    {
        $user = User::withTrashed()->findOrFail($id);

        if ($user->profile) {
            $imageService->deleteImage($user->profile);
        }
        if ($user->signature_image) {
            $imageService->deleteImage($user->signature_image);
        }

        $user->forceDelete();

        $this->removedUsers = User::onlyTrashed()->get();

        $this->alert('success', 'کاربر برای همیشه پاک شد', [
            'position' => 'bottom-start',
            'timer' => '4000',
            'toast' => true,
        ]);
    }

    public function restore(int $id)
    {
        $user = User::withTrashed()->findOrFail($id);

        $user->restore();

        $this->removedUsers = User::onlyTrashed()->get();

        $this->alert('success', 'کاربر با موفقیت بازیابی شد', [
            'position' => 'bottom-start',
            'timer' => '4000',
            'toast' => true,
        ]);
    }
}
