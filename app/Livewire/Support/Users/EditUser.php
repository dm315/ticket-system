<?php

namespace App\Livewire\Support\Users;


use App\Http\Services\Image\ImageService;
use App\Livewire\Forms\Support\User\EditUserForm;
use App\Models\Group;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditUser extends Component
{
    use WithFileUploads, LivewireAlert;

    public EditUserForm $form;

    public User $user;

    public function mount(User $user)
    {

        $this->form->fName = $user->fName;
        $this->form->lName = $user->lName;
        $this->form->email = $user->email;
        $this->form->position = $user->position;
        $this->form->group_id = $user->members()->pluck('id')->toArray();
        $this->form->role_id = $user->roles()->pluck('id')->toArray();
        $this->form->mobile = $user->mobile;;
        $this->form->gender = $user->gender;
        $this->form->connection = $user->connection;
        $this->form->birth = $user->birth;
        $this->form->mail_authority = explode(',', $user->mail_authority);
        $this->form->task_authority = explode(',', $user->task_authority);
    }

    protected $validationAttributesFromOutside = [
        'form.email' => 'پست الکترونیک',
        'form.group_id.*' => 'گروه سازمانی',
        'form.role_id.*' => 'نقش کاربری',
    ];

    public function rules()
    {
        return [
            'form.email' => 'required|email|min:10|max:255|unique:users,email,' . $this->user->id,
            'form.group_id.*' => 'required|numeric|exists:groups,id|distinct',
            'form.role_id.*' => 'required|numeric|exists:roles,id|distinct',
        ];
    }


    public function render()
    {
        if (Auth::user()->user_type == 0 && $this->user->id != Auth::user()->id) {
            abort(403);
        }

        $roles = Role::where('status', 1)->get(['id', 'persian_name']);
        $groups = Group::all(['id', 'name']);
        $title = "ویرایش " . $this->user->fullName;
        return view('livewire.support.users.edit-user', [
            'roles' => $roles,
            'groups' => $groups
        ])->title($title);
    }


    public function updateUser(ImageService $imageService)
    {
        $this->form->validate();
        $inputs = $this->form->all();

        if ($inputs['profile']) {
            if (!empty($this->user->profile)) {
                $imageService->deleteImage($this->user->profile);
            }
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
        } else {
            $inputs['profile'] = $this->user->profile;
        }

        if ($inputs['signature_image']) {
            if (!empty($this->user->signature_image)) {
                $imageService->deleteImage($this->user->signature_image);
            }
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
        } else {
            $inputs['signature_image'] = $this->user->signature_image;
        }

        $inputs['mobile'] = $inputs['mobile'] ? $this->form->fixedMobileNumber() : null;
        $inputs['connection'] = $inputs['connection'] == false ? 0 : 1;
        $inputs['mail_authority'] = count($inputs['mail_authority']) > 0 ? implode(",", $inputs['mail_authority']) : null;
        $inputs['task_authority'] = count($inputs['task_authority']) > 0 ? implode(",", $inputs['task_authority']) : null;

        DB::transaction(function () use ($inputs) {
            $this->user->update(Arr::except($inputs, ['group_id', 'role_id']));
            $this->user->members()->sync($inputs['group_id']);
            $this->user->roles()->sync($inputs['role_id']);
        });

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2000',
            'toast' => false,
            'text' => 'کاربر با موفقیت ویرایش شد',
        ]);

        $this->redirectRoute('dashboard.users.index');
    }
}
