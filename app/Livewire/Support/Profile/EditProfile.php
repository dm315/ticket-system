<?php

namespace App\Livewire\Support\Profile;

use App\Http\Services\Image\ImageService;
use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Livewire\Forms\Support\Profile\EditProfileForm;
use App\Models\Auth\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditProfile extends Component
{
    use WithFileUploads, LivewireAlert;

    public EditProfileForm $form;
    public User $user;
    public Otp $otp;

    public $userEmail, $disabled = false;

    public function mount(User $user)
    {
        if ($user->id != Auth::user()->id) abort(403);

        $this->form->fName = $user->fName;
        $this->form->lName = $user->lName;
        $this->form->email = $user->email;
        $this->form->position = $user->position;
        $this->form->mobile = $user->mobile;;
        $this->form->gender = $user->gender;
        $this->form->connection = $user->connection;
        $this->form->birth = $user->birth;
    }

    protected $validationAttributesFromOutside = [
        'form.email' => 'پست الکترونیک',
    ];

    public function rules()
    {
        return [
            'form.email' => 'required|email|min:10|max:255|unique:users,email,' . $this->user->id,
        ];
    }

    public function render()
    {
        $title = "ویرایش " . $this->user->fullName;
        return view('livewire.support.profile.edit-profile')->title($title);
    }


    public function updateUser(ImageService $imageService)
    {
        $this->form->validate();
        $inputs = $this->form->all();

        if ($this->form->email != $this->user->email) {
            $this->addError('form.email', 'لطفا پست الکترونیک خود را تایید کنید.');
            return false;
        }


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
            if (!$signature_image) {
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
        $inputs['connection'] = !$inputs['connection'] ? 0 : 1;

        $this->user->update($inputs);


        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '3500',
            'toast' => false,
            'text' => 'اطلاعات حساب شما با موفقیت ویرایش شد.',
        ]);

        $this->redirectRoute('dashboard.home');
    }

    private function createAndSendOtpCode($user, $email)
    {
        // Create OTP Code
        $OTP_code = rand(111111, 999999);
        $token = Str::random(60);
        $this->otp = Otp::create([
            'token' => $token,
            'user_id' => $user->id,
            'otp_code' => $OTP_code,
            'type' => 0,
        ]);

        // Send Mail to User
        $details = [
            'title' => 'ایمیل فعال سازی',
            'body' => "کد فعـــال سازی شما : $OTP_code"
        ];

        $emailService = new EmailService();

        $emailService->setDetails($details);
        $emailService->setFrom('noreply@gmail.com', 'example');
        $emailService->setSubject('سیستم تیکتینگ | کــد احراز هویت');
        $emailService->setTo($email);

        $messageService = new MessageService($emailService);

        $messageService->send();
    }

    public function sendOtpCode()
    {
        if ($this->form->email != $this->user->email) {
            $this->userEmail = substr_replace(strstr($this->form->email, "@", true), "*****", -5, 5) . strstr($this->form->email, "@");

            $this->dispatch('show-otp-form');

            $this->createAndSendOtpCode($this->user, $this->form->email);
        } else {
            $this->alert('error', 'قبلا این پست الکترونیک تایید شده است', [
                'position' => 'top-end',
                'timer' => '4000',
                'customClass' => [
                    'title' => 'text-white',
                    'popup' => 'bg-danger',
                ],
                'timerProgressBar' => true,
                'toast' => true,
            ]);
        }
    }

    public function confirmOtpCode()
    {

        if ($this->otp->created_at <= Carbon::now()->subMinute(2)->toDateTimeString() || $this->otp->used == 1) {
            $this->alert('error', 'این کد قبلا استفاده شده است یا زمان استفاده از آن گذشته است!', [
                'position' => 'top-end',
                'timer' => '4000',
                'customClass' => [
                    'title' => 'text-white',
                    'popup' => 'bg-danger',
                ],
                'timerProgressBar' => true,
                'toast' => true,
            ]);
            return false;
        }

        if ($this->otpCode != $this->otp->otp_code) {
            $this->alert('error', 'کــد فعالسازی نامعتبر می‌باشـــد!', [
                'position' => 'top-end',
                'timer' => '4000',
                'customClass' => [
                    'title' => 'text-white',
                    'popup' => 'bg-danger',
                ],
                'timerProgressBar' => true,
                'toast' => true,
            ]);
            return false;
        }

        $this->otp->update(['used' => 1]);
        $user = $this->otp->user;

        $user->update([
            'email_verified_at' => Carbon::now(),
            'email' => $this->form->email,
            'is_verified' => 1
        ]);

        $this->alert('success', 'عملیات موفقیت آمیز بود', [
            'position' => 'center',
            'timer' => '2500',
            'toast' => false,
            'text' => 'پست الکترونیک شما تایید گردید!',
        ]);

        $this->disabled = true;

        $this->dispatch('hide-otp-form');

    }


    public function resendOtp()
    {
        if ($this->otp->created_at >= Carbon::now()->subMinute(2)->toDateTimeString()) {
            $this->alert('error', 'قبلا برای شما کد تایید ارسال شده است و معتبر می‌باشد!', [
                'position' => 'top-end',
                'timer' => '4000',
                'customClass' => [
                    'title' => 'text-white',
                    'popup' => 'bg-danger',
                ],
                'timerProgressBar' => true,
                'toast' => true,
            ]);
            return false;
        }

        $user = $this->otp->user;

        //create and Send OtpCode
        $this->createAndSendOtpCode($user, $user->email);

        $this->alert('success', 'کد فعالسازی مجددا برای پست الکترونیک شما ارسال شد', [
            'position' => 'top-end',
            'timer' => '4000',
            'customClass' => [
                'title' => 'text-white',
                'popup' => 'bg-success',
            ],
            'timerProgressBar' => true,
            'toast' => true,
        ]);

    }
}
