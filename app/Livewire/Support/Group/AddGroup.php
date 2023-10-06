<?php

namespace App\Livewire\Support\Group;

use App\Http\Services\Image\ImageService;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddGroup extends Component
{
    use WithFileUploads, LivewireAlert;

    #[Rule('nullable|image|mimes:jpeg,png,jpg,webp|max:4096', as: 'تصویر گروه')]
    public $image;
    #[Rule('required|min:2|max:255', as: 'نام گروه')]
    public $name;
    #[Rule('nullable|numeric|exists:groups,id', as: 'زیر گروه')]
    public $parent_id;
//    #[Rule('required|min:2|max:255', as: 'نام سر گروه')]
//    public $group_leader;
    #[Rule('required|array|exists:users,id', as: 'افراد مجموعه')]
    public $members;


    public function render()
    {
        $groups = Group::whereNull('parent_id')->get();;
        $users = User::all(['id as value', 'fName', 'lName', 'email']);

        return view('livewire.support.group.add-group', [
            'groups' => $groups,
            'users' => $users,
        ])->title('افزودن گروه');
    }


    public function createGroup(ImageService $imageService)
    {
        $this->authorize('create-groups');

        $validated = $this->validate();
        $validated['group_leader_id'] = Auth::user()->id;

        if ($this->image) {
            $imageService->setExclusiveDirectory('uploads' . DIRECTORY_SEPARATOR . 'group');
            $image = $imageService->save($validated['image']);

            if ($image == false) {
                $this->alert('error', 'در بارگذاری تصویری خطا رخ داده است لطفا دوباره تلاش کنید', [
                    'position' => 'bottom-end',
                    'timer' => '4000',
                    'toast' => true,
                ]);
            }
            $validated['image'] = $image;
        }


        DB::transaction(function () use ($validated) {
            $group = Group::create(Arr::except($validated, ['members']));

            $group->users()->sync($validated['members']);
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
            'text' => 'گـــروه جدید با موفقیت ایجاد شد',
        ]);

        $this->redirectRoute('dashboard.groups.index');

    }

}
