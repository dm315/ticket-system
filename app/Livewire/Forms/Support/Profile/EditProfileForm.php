<?php

namespace App\Livewire\Forms\Support\Profile;

use Livewire\Attributes\Rule;
use Livewire\Form;

class EditProfileForm extends Form
{
    #[Rule('required|min:2|max:255', as: 'نام')]
    public $fName;

    #[Rule('required|min:2|max:255', as: 'نام حانوادگی')]
    public $lName;

    public $email;

    #[Rule('nullable|image|mimes:jpeg,png,jpg|max:4096', as: 'تصویر پروفایل')]
    public $profile;

    #[Rule('nullable|image|mimes:jpeg,png,jpg|max:4096', as: 'تصویر امضای دیجیتال')]
    public $signature_image;

    #[Rule('required|min:3|max:255', as: 'سمت کاربر')]
    public $position;

    #[Rule([['nullable'], ['numeric']], as: 'شماره تماس')]
    public $mobile;

    #[Rule('required', as: 'جنسیت')]
    public $gender;

    #[Rule('sometimes|boolean', as: 'ارتباطات ایمیلی')]
    public $connection = false;

    #[Rule('required')]
    public $birth;


    public function fixedMobileNumber()
    {
        $this->mobile = ltrim($this->mobile, '0');
        $this->mobile = substr($this->mobile, 0, 2) == "98" ? substr($this->mobile, 2) : $this->mobile;
        $this->mobile = str_replace("+98", "", $this->mobile);

        return $this->mobile;
    }
}
