@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}"/>
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
                    <a href="javascript:void(0);" class="h5">پــروژه ها</a>
                </li>
                <li class="breadcrumb-item active h5">ویرایش پــروژه</li>
            </ol>
        </nav>
    </div>


    <!-- Default Wizard -->
    <div class="col-12 mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="text-light fw-semibold">ویرایش پـــروژه</h4>
            <a href="javascript:history.back()" class="btn btn-label-primary">
                <i class='bx bx-right-arrow-alt'></i>
                بازگشت به لیست
            </a>
        </div>
        <div class="bs-stepper wizard-numbered mt-2">
            <div class="bs-stepper-header">
                <div class="step {{ $formStep == 1 ? 'active' : '' }}" x-on:click="$wire.set('formStep', '1')">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">1</span>
                        <span class="bs-stepper-label mt-1">
                           <span class="bs-stepper-title">ویرایش پروژه</span>
                            <span class="bs-stepper-subtitle">جزییات پروژه را با دقت لازم پر کنید.</span>
                          </span>
                    </button>
                </div>
                <div class="line">
                    <i class="bx bx-chevron-right"></i>
                </div>
                <div class="step {{ $formStep == 2 ? 'active' : '' }}" x-on:click="$wire.set('formStep', '2')">
                    <button type="button" class="step-trigger">
                        <span class="bs-stepper-circle">2</span>
                        <span class="bs-stepper-label mt-1">
                            <span class="">فایل های پروژه</span>
                            <span class="bs-stepper-subtitle">فایل های پروژه را در اینجا بارگذاری کنید.</span>
                          </span>
                    </button>
                </div>
            </div>
            <div class="bs-stepper-content">
                <form wire:submit="update" enctype="multipart/form-data" id="projectForm">
                    <!-- Create Project -->
                    <div class="content {{ $formStep != 1 ? 'd-none' : '' }}">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">ویرایش پـــروژه</h6>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label" for="title">عنوان
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" id="title" wire:model.blur="form.title"
                                       class="form-control @error('form.title') border-error @enderror"
                                />
                                @error('form.title')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="client_name">نام تحویل گیرنده (مشتری)
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" id="client_name" wire:model.blur="form.client"
                                       class="form-control @error('form.client') border-error @enderror"
                                />
                                @error('form.client')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="formValidationFile" class="form-label">تصویر لوگوی پروژه</label>
                                <div class="input-group hovering">
                                    <input type="file" wire:model="form.logo" class="form-control rounded"
                                           id="inputGroupFile04"
                                           aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                    @error('form.logo')
                                    <div class="w-100 text-center">
                                        <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                    </div>
                                    @enderror
                                    @if($project->logo)
                                        <div class="position-relative">
                                            <i class='bx bx-images cursor-pointer m-2'
                                               data-bs-toggle="tooltip"
                                               data-bs-offset="0,4"
                                               data-bs-placement="top"
                                               data-bs-original-title="<img src='{{ asset($project->logo) }}' class='rounded-2 shadow-sm mw-100'>"
                                               data-bs-html="true"
                                            >
                                            </i>
                                        </div>
                                    @endif
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <label for="selectpickerBasic" class="form-label">الویت
                                    <sup class="text-danger">*</sup>
                                </label>
                                <div wire:ignore>
                                    <select id="selectpickerBasic"
                                            class="selectpicker w-100 @error('form.priority') border-error @enderror"
                                            data-style="btn-default">
                                        <option value="0" @selected($form->priority == 0)>عادی</option>
                                        <option value="1" @selected($form->priority == 1)>فوری</option>
                                        <option value="2" @selected($form->priority == 2)>زمان دار</option>
                                    </select>
                                </div>
                                @error('form.priority')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="numeral-mask">مبلغ پروژه (تومان)
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" id="numeral-mask" wire:model.blur="form.price"
                                       class="form-control numeral-mask @error('form.price') border-error @enderror">
                                @error('form.price')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-sm-3">
                                <label class="form-label" for="date_end">تاریخ مهلت تحویل
                                    <sup class="text-danger">*</sup>
                                </label>
                                <input type="text" id="date_end" wire:model="form.end_date" class="form-control"
                                       data-jdp

                                       placeholder="{{ jdate(now())->format("%Y/%m/%d") }}"/>
                            </div>

                            <div class="col-sm-3">
                                <label for="group_id" class="form-label">انتخاب گروه
                                    <sup class="text-danger">*</sup>
                                </label>
                                <div wire:ignore>
                                    <select id="group_id"
                                            class="select2 form-select @error('form.group_id') border-error @enderror">
                                        <option disabled>انتخاب گـــروه</option>
                                        @foreach($groups as $group)
                                            <option
                                                value="{{ $group->id }}" @selected($form->group_id === $group->id)>{{ $group->name }}
                                                - ( {{ $group->groupLeader->fullName }} )
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('form.group_id')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label class="form-label" for="autosize-demo">توضیحات
                                    <sup class="text-danger">*</sup>
                                </label>
                                <textarea id="autosize-demo" wire:model.blur="form.description" rows="3"
                                          class="form-control @error('form.description') border-error @enderror"
                                          style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 150px;"></textarea>
                                @error('form.description')
                                <div class="w-100 text-center">
                                    <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                                </div>
                                @enderror
                            </div>

                            <div class="col-12 d-flex justify-content-between">
                                <div></div>
                                <button type="button" class="btn btn-primary btn-next" wire:click="firstStepForm">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">ادامه</span>
                                    <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Project Medias -->
                    <div id="social-links" class="content {{ $formStep != 2 ? 'd-none' : '' }}">
                        <div class="content-header mb-3">
                            <h6 class="mb-0">فایل های موردنیاز
                                <sup class="text-warning">(اختیاری)</sup>
                            </h6>
                            <small>لطفا فایل های مورد نیاز خود را بارگذاری کنید (حداکثر ۳ فایل )</small>
                        </div>
                        <div class="row g-3">
                            @if($project->medias()->count() > 0)
                                @foreach($project->medias as $media)
                                    <div class="col-4">
                                        <div class="card card-action mb-4 position-relative">
                                            <a wire:click="showConfirmDelete({{ $media->id }})" role="button"
                                               type="button"
                                               class="badge bg-label-dark rounded-circle shadow-sm position-absolute"
                                               style="top: -10px; right: -10px;"><i
                                                    class="tf-icons bx bx-x"></i>
                                            </a>
                                            <div class="card-body">
                                                <img src="{{ asset($media->file) }}" alt=""
                                                     class="shadow-sm rounded-2 w-100" style="object-fit: cover"
                                                     height="200">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <div class="col-12">
                                <div class="card">

                                    <div class="text-center" wire:loading wire:target="form.images">
                                        <span class="badge bg-label-gray fw-bold w-100">در حال بارگذاری تصویر...</span>
                                    </div>
                                    <div class="card-body">
                                        <div wire:ignore>
                                            <div class="dropzone" id="dropzone-multi">
                                                <div class="dz-message">
                                                    فایل ها را اینجا رها کنید یا برای آپلود کلیک کنید
                                                </div>
                                            </div>
                                        </div>
                                        @error('form.images')
                                        <div class="w-100 text-center">
                                            <small
                                                class="badge bg-label-youtube fw-bold w-100 p-2">{{ $message }}</small>
                                        </div>
                                        @enderror
                                        @error('form.images.*')
                                        <div class="w-100 text-center mt-1">
                                            <small
                                                class="badge bg-label-youtube fw-bold w-100 p-2">{{ $message }}</small>
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>


                            <div class="col-12 d-flex justify-content-between">
                                <button type="button" class="btn btn-primary btn-prev"
                                        x-on:click="$wire.set('formStep', '1')">
                                    <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                                    <span class="align-middle d-sm-inline-block d-none">مرحله قبل</span>
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <span class="align-middle d-sm-inline-block d-none me-sm-1">ثبت</span>
                                    <i class="bx bx-check bx-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Default Wizard -->

</div>


@section('script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/js/ui-popover.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendor/jalalidatepicker/jalalidatepicker.js') }}"></script>
    <script>
        $(function () {
            new Cleave('.numeral-mask', {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand'
            });

            jalaliDatepicker.startWatch({
                persianDigits: true,
                minDate: "today",
            });

            var select2 = $('.select2');
            select2.select2();
            select2.change(function (e) {
                var data = select2.val();
                @this.
                set('form.group_id', data);
            })

            const selectPicker = $('.selectpicker');

            // Bootstrap select
            if (selectPicker.length) {
                selectPicker.selectpicker();

                selectPicker.change(function (e) {
                    var selected = $(this).val();
                    @this.
                    set('form.priority', selected);
                })
            }


        })
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
                acceptedFiles: '.jpg,.jpeg,.png',
                maxFilesize: 5,
                addRemoveLinks: false,
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
                    upload('form.images', file);
                }
            })
        }
    </script>
@endsection
