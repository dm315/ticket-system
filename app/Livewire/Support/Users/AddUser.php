<?php

namespace App\Livewire\Support\Users;

use App\Http\Services\Image\ImageService;
use App\Livewire\Forms\Support\User\AddUserForm;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddUser extends Component
{
    use WithFileUploads, LivewireAlert;

    public AddUserForm $form;

    protected $validationAttributesFromOutside = [
        'form.group_id.*' => 'گروه سازمانی',
        'form.role_id.*' => 'نقش کاربری',
    ];

    public function rules()
    {
        return [
            'form.group_id.*' => 'required|numeric|exists:groups,id|distinct',
            'form.role_id.*' => 'required|numeric|exists:roles,id|distinct',
        ];
    }


    public function render()
    {
        $this->authorize('create-user');

        $roles = Role::where('status', 1)->get(['id', 'persian_name']);
        $groups = Group::all(['id', 'name']);
        return view('livewire.support.users.add-user', [
            'roles' => $roles,
            'groups' => $groups
        ])->title('افزودن کاربر');
    }


    public function createUser(ImageService $imageService)
    {
        $this->authorize('create-user');

        $this->form->validate();
        $inputs = $this->form->all();

        if ($inputs['profile']) {
            $imageService->setExclusiveDirectory('uploads' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'profile');
            $profile = $inputs['profile'] ? $imageService->save($inputs['profile']) : null;
            if ($profile == false) {
                $this->alert('error', 'در بارگذاری تصویری خطا رخ داده است لطفا دوباره تلاش کنید', [
                    'position' => 'bottom-end',
                    'timer' => '4000',
                    'toast' => true,
                ]);
            }
            $inputs['profile'] = $profile;
        }

        if ($inputs['signature_image']) {
            $imageService->setExclusiveDirectory('uploads' . DIRECTORY_SEPARATOR . 'users' . DIRECTORY_SEPARATOR . 'signature');
            $signature_image = $inputs['signature_image'] ? $imageService->save($inputs['signature_image']) : null;
            if ($signature_image == false) {
                $this->alert('error', 'در بارگذاری تصویری خطا رخ داده است لطفا دوباره تلاش کنید', [
                    'position' => 'bottom-end',
                    'timer' => '4000',
                    'toast' => true,
                ]);
            }
            $inputs['signature_image'] = $signature_image;
        }


        $inputs['mobile'] = $inputs['mobile'] ? $this->form->fixedMobileNumber() : null;
        $inputs['connection'] = $inputs['connection'] == false ? 0 : 1;
        $inputs['mail_authority'] = count($inputs['mail_authority']) > 0 ? implode(",", $inputs['mail_authority']) : null;
        $inputs['task_authority'] = count($inputs['task_authority']) > 0 ? implode(",", $inputs['task_authority']) : null;


        DB::transaction(function () use ($inputs) {
            $user = User::create(Arr::except($inputs, ['group_id', 'role_id']));
            $user->members()->sync($inputs['group_id']);
            $user->roles()->sync($inputs['role_id']);
        });


        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
            'text' => 'کاربر جدید با موفقیت ایجاد شد',
        ]);

        $this->redirectRoute('dashboard.users.index');
    }

}
