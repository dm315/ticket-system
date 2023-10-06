<?php

namespace App\Livewire\Auth;

use App\Http\Services\Message\Email\EmailService;
use App\Http\Services\Message\MessageService;
use App\Models\Auth\Otp;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    use LivewireAlert;


    #[Rule('required|string|min:3|max:120', as: 'نام')]
    public string $fName = '';
    #[Rule('required|string|min:3|max:120', as: 'نام خانوادگی')]
    public string $lName = '';
    #[Rule('required|email|unique:users,email|min:10|max:250', as: 'پست الکترونیک')]
    public string $email = '';
    #[Rule('required|string|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', as: 'کلمه عبور')]
    public string $password = '';
    #[Rule('required', as: 'قوانین')]
    public $termsCondition = '';
    #[Rule('nullable|bool')]
    public $rememberMe = '';

    // OTP CODE
    public Otp $otp;

    public $userEmail;
    public $otpCode = '';


    #[Title('سیستم تیکتینگ | ثبت نام')]
    #[Layout('components.layouts.auth')]
    public function render()
    {
        return view('livewire.auth.register');
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
        $inputs = $this->validate();

        $this->userEmail = substr_replace(strstr($inputs['email'], "@", true), "*****", -5, 5) . strstr($inputs['email'], "@");

        $user = User::create($inputs);

        // Show OTP Form Modal
        $this->dispatch('show-otp-form');

        $this->createAndSendOtpCode($user, $inputs['email']);
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
            'is_verified' => 1
        ]);

        Auth::login($user, $this->rememberMe);

        $this->redirectRoute('dashboard.home');
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
