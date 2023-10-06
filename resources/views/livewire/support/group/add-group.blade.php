@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}"/>
@endsection



<div>

    <div class="mb-3 ms-2 col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="h5">افراد مجموعه</a>
                </li>
                <li class="breadcrumb-item active h5">افزودن گروه جدید</li>
            </ol>
        </nav>
    </div>


    <div class="card">
        <h5 class="card-header">افزودن گروه جدید</h5>
        <!-- Account -->

        <div class="card-body" wire:ignore>

            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                    src="{{ asset('assets/img/icons/unicons/community.png') }}"
                    alt="user-avatar"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="uploadedAvatar"
                />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">بارگذاری تصویر لوگو</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                            type="file"
                            id="upload"
                            class="account-file-input"
                            hidden
                            wire:model="image"
                            accept="image/*"
                        />
                    </label>
                    <button type="button" class="btn btn-label-reddit account-image-reset mb-4">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">پاک کردن</span>
                    </button>

                    <p class="text-muted mb-0">فقط تصاویر JPG و PNG با نهایتا سایز ۴ مگابایت مجاز هستند!</p>
                    @error('image')
                    <div class="w-100 text-start mt-2">
                        <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                    </div>
                    @enderror
                    <div class="w-100 text-start mt-2" wire:loading wire:target="image">
                        <small class="badge bg-label-success fw-bold">درحال بارگذاری تصویر...</small>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-0"/>
        <form id="formAccountSettings" wire:submit="createGroup">
            <div class="card-body">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="firstName" class="form-label">نام گروه
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                            wire:model="name"
                            class="form-control @error('name') border-error @enderror"
                            type="text"
                            id="firstName"
                            name="firstName"
                            placeholder="مدیران سایت"
                            autofocus
                        />
                        @error('name')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-6" wire:ignore>
                        <label for="parent_id" class="form-label">زیر گـــروه
                        </label>
                        <select id="parent_id" class="select2 form-select @error('parent_id') border-error @enderror">
                            <option disabled>انتخاب زیر گـــروه</option>
                            <option value="">گـــروه اصـــلی</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}">{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_id')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    {{--                    <div class="mb-3 col-md-6">--}}
                    {{--                        <label for="group_leader" class="form-label">نام سر گــروه--}}
                    {{--                            <sup class="text-danger">*</sup>--}}
                    {{--                        </label>--}}
                    {{--                        <input--}}
                    {{--                            wire:model="group_leader"--}}
                    {{--                            class="form-control  @error('group_leader') border-error @enderror"--}}
                    {{--                            type="text"--}}
                    {{--                            id="group_leader"--}}
                    {{--                            name="firstName"--}}
                    {{--                            placeholder="دانیال مبینی"--}}
                    {{--                            autofocus--}}
                    {{--                        />--}}
                    {{--                        @error('group_leader')--}}
                    {{--                        <div class="w-100 text-center">--}}
                    {{--                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>--}}
                    {{--                        </div>--}}
                    {{--                        @enderror--}}
                    {{--                    </div>--}}

                    <div class="mb-3" wire:ignore>
                        <label for="TagifyUserList" class="form-label">افراد مجــموعه
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                            id="TagifyUserList"
                            name="TagifyUserList"
                            placeholder="افراد گروه خود را انتخاب کنید"
                            class="form-control @error('members') border-error @enderror"
                            required
                        />
                        @error('members')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">+ افزودن</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /Account -->
</div>

@section("script")
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/pages-account-settings-account.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
    <script>
        // Users List suggestion
        //------------------------------------------------------
        const TagifyUserListEl = document.querySelector('#TagifyUserList');
        const usersListId = document.getElementById('usersListId');


        function tagTemplate(tagData) {
            return `
                    <tag title="${tagData.title || tagData.email}"
                      contenteditable='false'
                      spellcheck='false'
                      tabIndex="-1"
                      class="${this.settings.classNames.tag} ${tagData.class ? tagData.class : ''}"
                      ${this.getAttributes(tagData)}
                    >
                      <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                      <div>
                        <span class='tagify__tag-text'>${tagData.fName + ' ' + tagData.lName}</span>
                      </div>
                    </tag>
                  `;
        }

        function suggestionItemTemplate(tagData) {
            return `
                    <div ${this.getAttributes(tagData)}
                      class='tagify__dropdown__item align-items-center ${tagData.class ? tagData.class : ''}'
                      tabindex="0"
                      role="option"
                    >
                      <strong>${tagData.fName + ' ' + tagData.lName}</strong>
                      <span>${tagData.email}</span>
                    </div>
                  `;
        }

        // initialize Tagify on the above input node reference
        let TagifyUserList = new Tagify(TagifyUserListEl, {
            tagTextProp: 'value', // very important since a custom template is used with this property as text. allows typing a "value" or a "name" to match input with whitelist
            enforceWhitelist: true,
            editTags: false,
            skipInvalid: true, // do not remporarily add invalid tags
            dropdown: {
                closeOnSelect: false,
                enabled: 0,
                classname: 'users-list',
                searchKeys: ['fName', 'lName', 'email'] // very important to set by which keys to search for suggesttions when typing
            },
            templates: {
                tag: tagTemplate,
                dropdownItem: suggestionItemTemplate
            },
        });
        TagifyUserList.whitelist = @js($users)

        TagifyUserList.DOM.originalInput.addEventListener('change', onTagsChange);

        function onTagsChange(e) {
            if (e.target.value.length > 0) {
                var tags = JSON.parse(e.target.value);
                const ids = [];
                tags.map((tag, i) => {
                    ids.push(tag.value);
                })
                @this.set('members', ids);
            }
        }

    </script>
    <script>
        // Select2 (jquery)
        $(function () {
            var select2 = $('.select2');
            // For all Select2
            if (select2.length) {
                select2.each(function () {
                    var $this = $(this);
                    $this.wrap('<div class="position-relative"></div>');
                    $this.select2({
                        dropdownParent: $this.parent()
                    });
                    $this.change(function (e) {
                        var data = $this.val();
                        @this.
                        set('parent_id', data);
                    })
                });
            }
        });
    </script>
@endsection
