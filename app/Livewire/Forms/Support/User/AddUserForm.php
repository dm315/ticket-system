<?php

namespace App\Livewire\Forms\Support\User;

use Livewire\Attributes\Rule;
use Livewire\Form;

class AddUserForm extends Form
{
    #[Rule('required|min:2|max:255', as: 'نام')]
    public $fName;

    #[Rule('required|min:2|max:255', as: 'نام حانوادگی')]
    public $lName;

    #[Rule('required|email|min:10|max:255|unique:users,email', as: 'پست الکترونیک')]
    public $email;

    #[Rule('required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', as: 'کلمه عبور')]
    public $password;

    #[Rule('nullable|image|mimes:jpeg,png,jpg|max:4096', as: 'تصویر پروفایل')]
    public $profile;

    #[Rule('nullable|image|mimes:jpeg,png,jpg|max:4096', as: 'تصویر امضای دیجیتال')]
    public $signature_image;

    #[Rule('required|min:3|max:255', as: 'سمت کاربر')]
    public $position;

    #[Rule([['nullable'], ['numeric']], as: 'شماره تماس')]
    public $mobile;

    public $group_id = [];
    public $role_id = [];

    #[Rule('required', as: 'جنسیت')]
    public $gender;

    #[Rule('sometimes|boolean', as: 'ارتباطات ایمیلی')]
    public $connection = false;

    #[Rule('required', as: 'تاریخ تولد')]
    public $birth;

    #[Rule('nullable', as: 'اختیارات')]
    public $mail_authority = [];

    #[Rule('nullable', as: 'اختیارات')]
    public $task_authority = [];


    public function fixedMobileNumber()
    {
        $this->mobile = ltrim($this->mobile, '0');
        $this->mobile = substr($this->mobile, 0, 2) == "98" ? substr($this->mobile, 2) : $this->mobile;
        $this->mobile = str_replace("+98", "", $this->mobile);

        return $this->mobile;
    }
}
