@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/jalalidatepicker/jalalidatepicker.css') }}"/>
@endsection



<div class="row">


    <div class="mb-3 ms-2 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="h5">کاربران</a>
                </li>
                <li class="breadcrumb-item active h5">ویرایش کاربر</li>
            </ol>
        </nav>
    </div>


    <!-- FormValidation -->
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>ویرایش کاربـــر ({{ $user->fullName }})</h5>
                @can('show-user')
                    <a href="{{ route('dashboard.users.index') }}" class="btn btn-label-primary">
                        <i class='bx bx-right-arrow-alt'></i>
                        بازگشت به لیست
                    </a>
                @endcan
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
                        <input
                            class="form-control @error('form.email') border-error @enderror"
                            type="email"
                            id="email"
                            name="formValidationEmail"
                            wire:model.blur="form.email"
                        />
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
                            @error('form.signature_image')
                            <div class="w-100 text-center">
                                <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                            </div>
                            @enderror
                            @if($user->signature_image)
                                <i class='bx bx-images cursor-pointer m-2'
                                   data-bs-toggle="tooltip" data-bs-offset="0,4"
                                   data-bs-placement="top" data-bs-html="true"
                                   data-bs-original-title="<span class='fw-bold text-muted'></span><img src='{{ asset($user->signature_image) }}' class='rounded-2 shadow-sm mw-100'>"
                                >
                                </i>
                            @endif
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
                        <label class="form-label" for="groups">گروه سازمانی
                            <sup class="text-danger">*</sup>
                        </label>
                        <div wire:ignore>
                            <select
                                wire:model.blur="form.group_id"
                                id="groups"
                                name="formValidationSelect2"
                                class="form-select select2"
                                multiple
                                data-allow-clear="true"
                            >
                                <option value="">لطفا گروه مورد نظر را انتخاب کنید</option>
                                @foreach($groups as $group)
                                    <option
                                        value="{{ $group->id }}" @selected(in_array($group->id,$form->group_id))>{{ $group->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('form.group_id.*')
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

                    <div class="col-md-6" wire:ignore>
                        <label class="form-label" for="formValidationHobbies">نقش کاربری
                            <sup class="text-danger">*</sup>
                        </label>
                        <div wire:ignore>
                            <select
                                class="selectpicker hobbies-select w-100"
                                id="formValidationHobbies"
                                wire:model="form.role_id"
                                data-style="btn-default"
                                data-icon-base="bx"
                                data-tick-icon="bx-check text-white"
                                name="formValidationHobbies"
                                multiple
                            >

                                @foreach($roles as $role)
                                    <option
                                        value="{{ $role->id }}" @selected(in_array($role->id, $form->role_id))>{{ $role->persian_name }}</option>
                                @endforeach

                            </select>
                        </div>
                        @error('form.role_id.*')
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

                    <div class="col-12">
                        <h6 class="mt-2 fw-semibold">۳. اختیارات</h6>
                        <hr class="mt-0"/>
                    </div>

                    <div class="col-md-6">
                        <p class="text-light fw-semibold">اختیارات نامه ها :</p>
                        <div class="form-check mt-3">
                            <input class="form-check-input @error('form.mail_authority') border-error @enderror"
                                   type="checkbox" value="0" id="defaultCheck1"
                                   @checked(in_array(0,$form->mail_authority))
                                   wire:model.blur="form.mail_authority">
                            <label class="form-check-label" for="defaultCheck1"> شروع نامه </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input @error('form.mail_authority') border-error @enderror"
                                   type="checkbox" value="1" id="defaultCheck2"
                                   @checked(in_array(1,$form->mail_authority))
                                   wire:model.blur="form.mail_authority">
                            <label class="form-check-label" for="defaultCheck2"> بررسی اولیه نامه </label>
                        </div>
                        <div class="form-check mt-3">
                            <input class="form-check-input @error('form.mail_authority') border-error @enderror"
                                   type="checkbox" value="2" id="defaultCheck3"
                                   @checked(in_array(2,$form->mail_authority))
                                   wire:model.blur="form.mail_authority">
                            <label class="form-check-label" for="defaultCheck3"> بایگانی نامه </label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <p class="text-light fw-semibold">اختیارات وظایف :</p>
                        <div class="row g-1">
                            <div class="col-6">
                                <div class="form-check mt-3">
                                    <input class="form-check-input @error('form.task_authority') border-error @enderror"
                                           type="checkbox" value="0" id="defaultCheck5"
                                           @checked(in_array(0,$form->task_authority))
                                           wire:model.blur="form.task_authority">
                                    <label class="form-check-label" for="defaultCheck5"> شروع وظیفه </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input @error('form.task_authority') border-error @enderror"
                                           type="checkbox" value="1" id="defaultCheck6"
                                           @checked(in_array(1,$form->task_authority))
                                           wire:model.blur="form.task_authority">
                                    <label class="form-check-label" for="defaultCheck6"> بررسی اولیه وظیفه </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input @error('form.task_authority') border-error @enderror"
                                           type="checkbox" value="2" id="defaultCheck7"
                                           @checked(in_array(2,$form->task_authority))
                                           wire:model.blur="form.task_authority">
                                    <label class="form-check-label" for="defaultCheck7"> تکمیل وظیفه </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check mt-3">
                                    <input class="form-check-input @error('form.task_authority') border-error @enderror"
                                           type="checkbox" value="3" id="defaultCheck8"
                                           @checked(in_array(3,$form->task_authority))
                                           wire:model.blur="form.task_authority">
                                    <label class="form-check-label" for="defaultCheck8"> خاتمه وظیفه </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input @error('form.task_authority') border-error @enderror"
                                           type="checkbox" value="4" id="defaultCheck9"
                                           @checked(in_array(4,$form->task_authority))
                                           wire:model.blur="form.task_authority">
                                    <label class="form-check-label" for="defaultCheck9"> اتمام تسک </label>
                                </div>
                                <div class="form-check mt-3">
                                    <input class="form-check-input @error('form.task_authority') border-error @enderror"
                                           type="checkbox" value="5" id="defaultCheck10"
                                           @checked(in_array(5,$form->task_authority))
                                           wire:model.blur="form.task_authority">
                                    <label class="form-check-label" for="defaultCheck10"> لغو شده </label>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12">
                        <button type="submit" name="submitButton" class="btn btn-primary">ویرایش</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /FormValidation -->
</div>


@section('script')
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('vendor/jalalidatepicker/jalalidatepicker.js') }}"></script>
    <script type="text/javascript">
        jalaliDatepicker.startWatch({
            minDate: "attr",
            maxDate: "attr",
        });

        var select2 = $('.select2');
        select2.select2();
        select2.change(function (e) {
            var data = select2.val();
            @this.
            set('form.group_id', data);
        })
    </script>
@endsection
