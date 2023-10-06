@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/quill/typography.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}"/>
    <link rel="stylesheet" href="{{ asset('vendor/jalalidatepicker/jalalidatepicker.css') }}"/>
@endsection


<div>

    <div class="mb-3 ms-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="h5">تســک ها</a>
                </li>
                <li class="breadcrumb-item active h5">ایجاد تـســک</li>
            </ol>
        </nav>
    </div>


    <div class="col-12 my-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="text-light fw-semibold">ویرایش تـســـک</h3>
            <a href="javascript:history.back()" class="btn btn-label-primary">
                <i class='bx bx-right-arrow-alt'></i>
                بازگشت به لیست
            </a>
        </div>
        <div class="bs-stepper wizard-vertical vertical wizard-vertical-icons-example mt-2">
            <!-- RIGHT SIDEBAR -->
            <div class="bs-stepper-header">
                <div class="step {{ $formStep === 1 ? 'active' : null }}" @click="$wire.set('formStep',1)">
                    <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">
                            <i class="bx bx-detail"></i>
                          </span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">تعریف تسک</span>
                            <span class="bs-stepper-subtitle">لطفا جزییات تسک را با دقت پر کنید</span>
                          </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step {{ $formStep === 2 ? 'active' : null }}" @click="$wire.set('formStep',2)">
                    <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">
                            <i class="fa-solid fa-file-import"></i>
                          </span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">فایل های تسک</span>
                            <span class="bs-stepper-subtitle">فایل های تسک را در اینجا بارگذاری کنید</span>
                          </span>
                    </button>
                </div>
                <div class="line"></div>
                <div class="step {{ $formStep === 3 ? 'active' : null }}" @click="$wire.set('formStep',3)">
                    <button type="button" class="step-trigger">
                          <span class="bs-stepper-circle">
                            <i class="fa-solid fa-user-group"></i>
                          </span>
                        <span class="bs-stepper-label mt-1">
                            <span class="bs-stepper-title">گیرندگان</span>
                            <span class="bs-stepper-subtitle">این تسک/نامه مختص به کدام ادمین است؟</span>
                          </span>
                    </button>
                </div>
            </div>

            <!-- CONTENT -->
            <div class="bs-stepper-content">
                <form wire:submit="update">
                    <!-- Create Task -->
                    <div id="account-details-vertical"
                         class="content {{ $formStep === 1 ? 'active dstepper-block' : null }}">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">تعریف نامه / وظــیفه</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label">نوع تسک
                                    <sup class="text-danger">*</sup>
                                </label>
                                <div class="row">
                                    <div class="col-md mb-md-0 mb-2">
                                        <div class="form-check custom-option custom-option-basic">
                                            <label class="form-check-label custom-option-content"
                                                   for="mail">
                                                <input name="mail"
                                                       class="form-check-input"
                                                       type="radio"
                                                       value="0"
                                                       id="mail"
                                                       wire:model.blur="type"
                                                    @checked($type == 0)
                                                >
                                                <span class="custom-option-header">
                                                    <span class="h6 mb-0">نـــامـــه</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md">
                                        <div class="form-check custom-option custom-option-basic">
                                            <label class="form-check-label custom-option-content"
                                                   for="task">
                                                <input name="task"
                                                       class="form-check-input"
                                                       type="radio"
                                                       value="1"
                                                       id="task"
                                                       wire:model.blur="type"
                                                    @checked($type == 1)
                                                >
                                                <span class="custom-option-header">
                                                    <span class="h6 mb-0">وظیـــفه</span>
                                                </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('type')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="priority" class="form-label">الویت
                                    <sup class="text-danger">*</sup>
                                </label>
                                <div wire:ignore>
                                    <select id="priority"
                                            wire:model.blur="priority"
                                            class="selectpicker w-100 @error('priority') border-error @enderror"
                                            data-style="btn-default">
                                        <option value="0" @selected($priority == 0)>عادی</option>
                                        <option value="1" @selected($priority == 1)>لحظه ای</option>
                                        <option value="2" @selected($priority == 2)>آنی</option>
                                    </select>
                                </div>
                                @error('priority')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="date_end">تاریخ مهلت
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" id="date_end" wire:model="due_date"
                                       class="form-control @error('due_date') border-error @enderror"
                                       data-jdp
                                       placeholder="{{ jdate(now())->format("%Y/%m/%d") }}"/>
                                @error('due_date')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-sm-12">
                                <label class="form-label" for="subject_input">موضوع
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" id="subject_input" wire:model.blur="subject"
                                       class="form-control @error('subject') border-error @enderror"
                                       placeholder="موضوع نامه یا وظیفه"/>
                                @error('subject')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="task_description">متن
                                    <sup class="text-danger">*</sup>
                                </label>
                                <div>
                                    <textarea wire:model.blur="description"
                                              class="form-control form-control-sm @error('description') border-error @enderror"
                                              id="task_description" cols="30"
                                              rows="10"></textarea>
                                </div>
                                @error('description')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <div></div>
                                <button type="button" class="btn btn-primary btn-next"
                                        wire:click.prevent="firstStepForm">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">ادامه</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Upload Files -->
                    <div id="personal-info-vertical"
                         class="content {{ $formStep === 2 ? 'active dstepper-block' : null }}">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">فایل های موردنیاز
                                <sup class="text-warning">(اختیاری)</sup>
                            </h6>
                            <small>لطفا فایل های مورد نیاز خود را بارگذاری کنید (حداکثر ۳ فایل )</small>
                            <small class="d-block mt-1">فایل های مجاز: ( jpeg,png,jpg,zip,pdf )</small>
                        </div>
                        <div class="row g-3">
                            @if($task->medias()->count() > 0)
                                @foreach($task->medias as $media)
                                    <div class="col-4" wire:key="{{ $media->id }}">
                                        <div class="card card-action mb-4 position-relative h-100">
                                            <a wire:click="showConfirmDelete({{ $media->id }})" role="button"
                                               type="button"
                                               class="badge bg-label-dark rounded-circle shadow-sm position-absolute"
                                               style="top: -10px; right: -10px;"><i
                                                    class="tf-icons bx bx-x"></i>
                                            </a>
                                            <div class="card-body d-flex justify-content-center align-items-center">
                                                @if(is_image($media->file))
                                                    <img src="{{ asset($media->file) }}" alt=""
                                                         class="shadow-sm rounded-2 w-100 h-100"
                                                         style="object-fit: cover">
                                                @else
                                                    <div class="w-100">
                                                        <a href="{{ asset($media->file) }}"
                                                           class="btn btn-label-dark w-100 shadow">
                                                            <i class='bx bx-cloud-download'></i>
                                                            مشاهده فایل
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif


                            <div class="col-12">
                                <div class="card">

                                    <div class="card-body">
                                        <div wire:ignore>
                                            <div class="dropzone" id="dropzone-multi">
                                                <div class="dz-message">
                                                    فایل ها را اینجا رها کنید یا برای آپلود کلیک کنید
                                                </div>
                                            </div>
                                        </div>
                                        @error('files')
                                        <div class="w-100 text-center">
                                            <small
                                                class="badge bg-label-youtube fw-bold w-100 p-2">{{ $message }}</small>
                                        </div>
                                        @enderror
                                        @error('files.*')
                                        <div class="w-100 text-center mt-1" style="opacity: .8">
                                            <small
                                                class="badge bg-label-youtube fw-bold w-100 p-2">{{ $message }}</small>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev" @click="$wire.set('formStep',1)">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">مرحله قبل</span>
                                </button>
                                <button type="button" class="btn btn-primary btn-next"
                                        wire:click.prevent="secondStepForm">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">ادامه</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Receiver's List -->
                    <div id="social-links-vertical"
                         class="content {{ $formStep === 3 ? 'active dstepper-block' : null }}">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">گیرندگان</h6>
                            <small>تسک مربوطه شما برای کدام یک از افراد مجموعه می‌باشد؟</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="details" class="pt-3 pt-lg-0">
                                            <div class="row">
                                                <div class="mb-3 col-6">
                                                    <label for="search_receiver">جستجوی بین کاربران</label>
                                                    <div class="input-group input-group-merge">
                                                    <span class="input-group-text" id="search_receiver"><i
                                                            class="bx bx-search"></i></span>
                                                        <input type="text" class="form-control"
                                                               placeholder="جستجو بر اساس نام یا پست الکترونیک..."
                                                               aria-label="Search..."
                                                               wire:model.live.debounce.500ms="searchUser"
                                                               aria-describedby="basic-addon-search31">
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-6">
                                                    <label for="user_type">انتخاب نوع کاربر</label>
                                                    <div class="input-group input-group-merge">
                                                        <span class="input-group-text"><i
                                                                class="bx bx-user"></i></span>
                                                        <select id="user_type" class="form-select"
                                                                wire:model.live="user_type">
                                                            <option value="0">کاربر</option>
                                                            <option value="1">ادمین</option>
                                                            <option value="2">سوپر ادمین</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between align-items-center border-bottom border-3">
                                                <h5 class="py-2">انتخاب دریافت کنندگان</h5>

                                                @error('receivers')
                                                <div>
                                                    <small
                                                        class="badge bg-label-youtube fw-bold mb-3">{{ $message }}</small>
                                                </div>
                                                @enderror
                                                @error('receivers.*')
                                                <div>
                                                    <small
                                                        class="badge bg-label-youtube fw-bold mb-3">{{ $message }}</small>
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="demo-inline-spacing mt-3">
                                                <div class="list-group">
                                                    @forelse($users as $user)
                                                        <label
                                                            wire:key="{{ $user->id }}"
                                                            for="user-{{ $user->id }}"
                                                            class="list-group-item list-group-item-action d-flex align-items-center cursor-pointer">
                                                            <input class="form-check-input me-1"
                                                                   wire:model="receivers"
                                                                   id="user-{{ $user->id }}"
                                                                   type="checkbox"
                                                                   value="{{ $user->id }}"
                                                                @checked(in_array($user->id,$receivers))
                                                            >
                                                            <div class="avatar-wrapper">
                                                                <div class="avatar me-2">
                                                                    @if($user->profile)
                                                                        <img src="{{ asset($user->profile) }}" alt=""
                                                                             class="rounded-circle me-3">
                                                                    @else
                                                                        {!! avatar($user->fName,$user->lName) !!}
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="w-100">
                                                                @php
                                                                    $roles = $user->roles->pluck('persian_name');
                                                                    $rolesName = implode(', ', $roles->toArray());
                                                                @endphp
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center">
                                                                    <div class="user-info">
                                                                        <h6 class="mb-1">{{ $user->fullName }}
                                                                            <small
                                                                                class="text-muted">@if(!empty($rolesName))
                                                                                    ( {{ $rolesName }} )
                                                                                @endif</small>
                                                                        </h6>
                                                                        <small>{{ $user->email }}</small>
                                                                    </div>

                                                                    <div>
                                                                        @if($user->user_type == 0)
                                                                            <span
                                                                                class="badge bg-label-secondary fw-bold">کاربر</span>
                                                                        @elseif($user->user_type == 1)
                                                                            <span
                                                                                class="badge bg-label-warning fw-bold">ادمین</span>
                                                                        @else
                                                                            <span
                                                                                class="badge bg-label-info fw-bold">سوپر ادمین</span>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </label>
                                                    @empty
                                                        <div class="alert alert-dark text-center shadow shadow-sm">
                                                            <p class="text-white mb-0">کاربری با این مشخصات یافت
                                                                نشد.</p>
                                                        </div>

                                                    @endforelse
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev" @click="$wire.set('formStep',2)">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">مرحله قبل</span>
                                </button>
                                <button type="submit" class="btn btn-success btn-submit">ویرایش تسک</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@section('script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendor/jalalidatepicker/jalalidatepicker.js') }}"></script>
    <script>
        jalaliDatepicker.startWatch({
            persianDigits: true,
            minDate: "today",
        });
    </script>
    <script>
        const previewTemplate = `<div class="dz-preview dz-file-preview">
                                             <div class="dz-details">
                                      <div class="dz-thumbnail">
                                        <img data-dz-thumbnail>
                                        <span class="dz-nopreview">بدون پیش نمایش</span>
                                        <div class="dz-success-mark"></div>
                                        <div class="dz-error-mark"></div>
                                        <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                        <div class="progress">
                                          <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                                        </div>
                                      </div>
                                      <div class="dz-filename" data-dz-name></div>
                                      <div class="dz-size" data-dz-size></div>
                                    </div>
                                     </div>`;

        if (document.getElementById('dropzone-multi')) {
            const dropzoneMulti = new Dropzone('div#dropzone-multi', {
                url: '/upload',
                previewTemplate: previewTemplate,
                maxFiles: 3,
                parallelUploads: 1,
                acceptedFiles: '.jpg,.jpeg,.png,.zip,.pdf',
                maxFilesize: 3000000,
                addRemoveLinks: false,
                preventDuplicates: true
            });
            dropzoneMulti.on("addedfile", function (file) {
                if (this.files.length) {
                    var _i, _len;
                    for (_i = 0, _len = this.files.length; _i < _len - 1; _i++) {
                        if (this.files[_i].name === file.name && this.files[_i].size === file.size && this.files[_i].lastModifiedDate.toString() === file.lastModifiedDate.toString()) {
                            this.removeFile(file);
                        }
                    }
                    @this.
                    upload('files', file);
                }
            })
        }
    </script>
@endsection
