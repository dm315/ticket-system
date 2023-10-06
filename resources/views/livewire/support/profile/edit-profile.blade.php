@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/jalalidatepicker/jalalidatepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/spinkit/spinkit.css') }}"/>
@endsection



<div class="row">


    <div class="mb-3 ms-2 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="h5">پروفایل</a>
                </li>
                <li class="breadcrumb-item active h5">ویرایش حساب کاربری</li>
            </ol>
        </nav>
    </div>


    <!-- FormValidation -->
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>ویرایش اطلاعات کاربری</h5>
            </div>
            <div class="card-body">
                <form id="formValidationExamples" wire:submit="updateUser" class="row g-3"
                      enctype="multipart/form-data">
                    <!-- Account Details -->

                    <div class="col-12">
                        <h6 class="fw-semibold">۱. اطلاعات اولیه</h6>
                        <hr class="mt-0"/>
                    </div>

                    <div class="col-md-6">
                        <div class="row g-1">
                            <div class="col-md-6">
                                <label class="form-label" for="fName">
                                    نام
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input
                                    type="text"
                                    id="fName"
                                    class="form-control @error('form.fName') border-error @enderror"
                                    name="formValidationName"
                                    wire:model.blur="form.fName"
                                />
                                @error('form.fName')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="lName">نام خانوادگی
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input
                                    type="text"
                                    id="lName"
                                    class="form-control @error('form.lName') border-error @enderror"
                                    name="formValidationName"
                                    wire:model.blur="form.lName"
                                />
                                @error('form.lName')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="email">پست الکترونیک
                            <sup class="text-danger">*</sup>
                        </label>
                        <div class="input-group" x-data="{ show : false }">
                            <input type="text" class="form-control" id="email" wire:model.blur="form.email"
                                   x-on:change="show = true"
                                   aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button
                                @disabled($disabled)
                                x-ref="confirmEmail"
                                class="btn btn-outline-dark" x-show="show" x-transition
                                type="button"
                                wire:click.prevent="sendOtpCode"
                                id="button-addon2">
                                <span wire:loading.remove wire:target="sendOtpCode">تایید ایمیل</span>
                                <div wire:loading wire:target="sendOtpCode">
                                    <div class="sk-wave mx-auto">
                                        <div class="sk-rect sk-wave-rect"></div>
                                        <div class="sk-rect sk-wave-rect"></div>
                                        <div class="sk-rect sk-wave-rect"></div>
                                        <div class="sk-rect sk-wave-rect"></div>
                                        <div class="sk-rect sk-wave-rect"></div>
                                    </div>
                                </div>

                            </button>
                        </div>
                        @error('form.email')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <!-- Personal Info -->

                    <div class="col-12">
                        <h6 class="mt-2 fw-semibold">۲. اطلاعات تکمیلی</h6>
                        <hr class="mt-0"/>
                    </div>

                    <div class="col-md-6">
                        <label for="profilePic" class="form-label">تصویر پروفایل
                            <sup class="text-warning">(jpeg,png,jpg)</sup>
                        </label>
                        <div class="input-group">
                            <input type="file"
                                   class="form-control rounded @error('form.profile') border-error @enderror"
                                   id="profilePic"
                                   accept="image/*"
                                   aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                                   wire:model.blur="form.profile"
                            >
                            @if($user->profile)
                                <i class='bx bx-images cursor-pointer m-2'
                                   data-bs-toggle="tooltip" data-bs-offset="0,4"
                                   data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="<span class='fw-bold text-muted'></span><img src='{{ asset($user->profile) }}' class='rounded-2 shadow-sm mw-100'>"
                                >
                                </i>
                            @endif
                        </div>
                        @error('form.profile')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                        <div class="w-100 text-start mt-2" wire:loading wire:target="form.profile">
                            <small class="badge bg-label-success fw-bold">درحال بارگذاری تصویر...</small>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <label for="signaturePic" class="form-label">تصویر امضای دیجیتال
                            <sup class="text-warning">(jpeg,png,jpg)</sup>
                        </label>
                        <div class="input-group">
                            <input type="file"
                                   class="form-control rounded @error('form.signature_image') border-error @enderror"
                                   id="signaturePic"
                                   accept="image/*"
                                   aria-describedby="inputGroupFileAddon04" aria-label="Upload"
                                   wire:model.blur="form.signature_image"
                            >
                            @if($user->signature_image)
                                <i class='bx bx-images cursor-pointer m-2'
                                   data-bs-toggle="tooltip" data-bs-offset="0,4"
                                   data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="<span class='fw-bold text-muted'></span><img src='{{ asset($user->signature_image) }}' class='rounded-2 shadow-sm mw-100'>"
                                >
                                </i>
                            @endif
                            @error('form.signature_image')
                            <div class="w-100 text-center">
                                <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                            </div>
                            @enderror
                            <div class="w-100 text-start mt-2" wire:loading wire:target="form.signature_image">
                                <small class="badge bg-label-success fw-bold">درحال بارگذاری تصویر...</small>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="position">سِمَت کاربر
                        </label>
                        <input
                            type="text"
                            class="form-control @error('form.position') border-error @enderror"
                            name="formValidationDob"
                            id="position"
                            wire:model.blur="form.position"
                        />
                        @error('form.position')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="mobile_number">
                            شماره تماس
                        </label>

                        <input type="text" id="mobile_number"
                               class="form-control phone-mask @error('form.mobile') border-error @enderror"
                               placeholder="لطفا شماره تماس را بدون صفر وارد کنید" aria-label="912 9999 999"
                               wire:model.blur="form.mobile"
                        >
                        @error('form.mobile')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>


                    <div class="col-md-6">
                        <label class="form-label" for="datePicker">تاریخ تولد</label>
                        <input
                            data-jdp
                            data-jdp-max-date="today"
                            type="text"
                            class="form-control"
                            name="datePicker"
                            id="datePicker"
                            wire:model.blur="form.birth"
                        />
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">جنسیت
                            <sup class="text-danger">*</sup>
                        </label>
                        <div class="form-check custom mb-2">
                            <input
                                type="radio"
                                id="men"
                                name="men"
                                value="0"
                                class="form-check-input @error('form.gender') border-error @enderror"
                                wire:model.blur="form.gender"
                            />
                            <label class="form-check-label" for="men">آقا</label>
                        </div>

                        <div class="form-check custom">
                            <input
                                type="radio"
                                id="women"
                                name="women"
                                value="1"
                                class="form-check-input @error('form.gender') border-error @enderror"
                                wire:model.blur="form.gender"
                            />
                            <label class="form-check-label" for="women">خانم</label>
                        </div>
                        @error('form.gender')
                        <div class="">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>


                    <div class="col-md-3 d-flex align-items-center">
                        <label class="switch switch-primary">
                            <input type="checkbox" class="switch-input" @checked($form->connection)
                            wire:model.blur="form.connection"/>
                            <span class="switch-toggle-slider">
                              <span class="switch-on"></span>
                              <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">ارسال ایمیل های مرتبط</span>
                        </label>
                    </div>


                    <div class="col-12 text-end">
                        <a href="{{ route('dashboard.home') }}" class="btn btn-secondary me-2">انصراف</a>
                        <button type="submit" name="submitButton" class="btn btn-primary">ویرایش</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /FormValidation -->
    @include('livewire.partials.Auth.OTP-form-modal', ['userEmail' => $userEmail ?? ''])
</div>


@section('script')
    <script src="{{ asset('vendor/jalalidatepicker/jalalidatepicker.js') }}"></script>
    <script src="{{ asset('assets/js/pages-auth-two-steps.js') }}"></script>

    <script>
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('show-otp-form', () => {
                $('#twoFactorAuth').modal('show');
            })

            Livewire.on('hide-otp-form', () => {
                $('#twoFactorAuth').modal('hide');
            })
        })
    </script>
    <script type="text/javascript">
        jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "attr",
        });
    </script>
@endsection
