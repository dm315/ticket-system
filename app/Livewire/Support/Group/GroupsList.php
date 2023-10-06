<?php

namespace App\Livewire\Support\Group;

use App\Http\Services\Image\ImageService;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class GroupsList extends Component
{
    use WithPagination, LivewireAlert, WithFileUploads;

    #[Rule('nullable|image|mimes:jpeg,png,jpg|max:4096', as: 'تصویر گروه')]
    public $image;
    #[Rule('required|min:2|max:255', as: 'نام گروه')]
    public $name;
    #[Rule('nullable|numeric|exists:groups,id', as: 'زیر گروه')]
    public $parent_id;
    #[Rule('required|array|exists:users,id', as: 'افراد مجموعه')]
    public $members;

    public $oldImage, $oldMembers;
    public $parent_groups;
    public int $groupId, $group_leader_id;
    public string $search = '';


    public function render()
    {
        $this->authorize('show-groups');

        $groups = Group::search($this->search)->with(['groupLeader'])->latest()->paginate(10);
        $users = User::all(['id as value', 'fName', 'lName', 'email']);

        return view('livewire.support.group.groups-list', [
            'groups' => $groups,
            'users' => $users->toArray(),
        ])->title('لیست گروه ها');
    }

    public function edit(Group $group)
    {
        $this->group_leader_id = $group->groupLeader->id ?? null;
        $this->groupId = $group->id;
        $this->name = $group->name;
        $this->oldImage = $group->image;
        $this->parent_groups = Group::whereNull('parent_id')->get()->except($group->id);
        $this->parent_id = $group->parent_id;
        $this->oldMembers = $group->users()->get(['id as value', 'fName', 'lName', 'email'])->toArray() ?? null;
        $this->dispatch('show-edit-form');
        $this->dispatch('get-oldMembers', data: $this->oldMembers);

    }

    public function update(ImageService $imageService)
    {

        $this->authorize('update-groups');

        $validated = $this->validate();
        $validated['group_leader_id'] = $this->group_leader_id;


        if ($this->image) {
            if (!empty($this->oldImage)) {
                $imageService->deleteImage($this->oldImage);
            }
            $imageService->setExclusiveDirectory('uploads' . DIRECTORY_SEPARATOR . 'group');
            $image = $imageService->save($validated['image']);

            if ($image == false) {
                $this->alert('error', 'در بارگذاری تصویری خطا رخ داده است لطفا دوباره تلاش کنید', [
                    'position' => 'bottom-start',
                    'timer' => '4000',
                    'toast' => true,
                    'customClass' => [
                        'popup' => 'bg-danger',
                        'title' => 'text-white'
                    ]
                ]);
            }
            $validated['image'] = $image;
        }

        DB::transaction(function () use ($validated) {
            $group = Group::find($this->groupId);
            $group->update(Arr::except($validated, ['members']));

            $group->users()->sync($validated['members']);
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
            'text' => 'گـــروه با موفقیت ویرایش شد',
        ]);
        $this->dispatch('hide-edit-form');
    }


    public function showConfirmRemove(int $id)
    {
        $this->groupId = $id;


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
    public function removeGroup()
    {
        $this->authorize('delete-groups');

        $group = Group::find($this->groupId);

        $group->delete();
    }
}
