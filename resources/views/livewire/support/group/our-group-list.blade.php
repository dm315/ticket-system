@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}"/>
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
                <li class="breadcrumb-item active h5">لیست گروه های شما</li>
            </ol>
        </nav>
    </div>


    <div class="card">
        <div class="card-header">
            <h5 class="">لیست گروه های - ( {{ auth()->user()->fullName }} )</h5>
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-end">
                    <div class="d-flex ">
                        <select
                            id="group_type"
                            wire:model.live="group_type"
                            class="form-select">
                            <option value="0" selected>لیست گروه های شما</option>
                            <option value="1">لیست گروه هایی که شما عضو آن هستید</option>
                        </select>
                    </div>

                    <div class="mx-2">
                        <div class="input-group input-group-merge">
                    <span class="input-group-text cursor-pointer" id="basic-addon-search31"><i
                            class="bx bx-search"></i></span>
                            <input type="text" class="form-control"
                                   wire:model.live.debounce.850ms="search"
                                   placeholder="جستجو براساس نام..."
                                   aria-label="Search..."
                                   aria-describedby="basic-addon-search31">
                        </div>
                    </div>
                    <div class="">
                        <a href="{{ route('dashboard.groups.add') }}" class="btn btn-primary">+ افزودن گروه
                            جدید</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>نام گـــروه</th>
                    <th>زیر گـــروه</th>
                    <th>سر گـــروه</th>
                    <th>افراد مجموعه</th>
                    @if($group_type == 0)
                        <th class="text-center">عملیات</th>
                    @endif
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">

                @forelse($groups as $group)
                    <tr wire:key="{{ $group->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        @if($group->image)
                                            <img src="{{ asset($group->image) }}"
                                                 class="rounded-circle">
                                        @else
                                            {{ ' ' }}
                                        @endif
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <span
                                        class="emp_name text-truncate">
                                        {{ $group->name }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($group->parent_id == null)
                                <span class="badge bg-label-success fw-bold">گـــروه اصـــلی</span>
                            @else
                                <span class="badge bg-label-warning fw-bold">{{ $group->parent->name }}</span>
                            @endif
                        </td>
                        <td>{{ $group->groupLeader->fullName ?? "فاقد سرگرو‍ه" }}</td>
                        <td>
                            <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                                @foreach($group->users as $member)
                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                        class="avatar avatar-xs pull-up" aria-label="{{ $member->fullName }}"
                                        data-bs-original-title="{{ $member->fullName }}">
                                        @if($member->profile)
                                            <img src="{{ asset($member->profile) }}" alt="Avatar"
                                                 class="rounded-circle">
                                        @else
                                            {!! avatar($member->fName, $member->lName) !!}
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        @if($group_type == 0)
                            <td class="text-end">
                                <button type="button" class="btn btn-label-info btn-sm"
                                        wire:click="edit({{ $group }})"
                                >
                                    <span class="tf-icons bx bx-edit-alt me-1"></span>ویرایش
                                </button>
                                <button type="button" wire:click.prevent="showConfirmRemove({{ $group->id }})"
                                        class="btn btn-label-danger btn-sm">
                                    <span class="tf-icons bx bx bx-trash me-1"></span>حذف
                                </button>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr class="text-center">
                        <td valign="top" colspan="6" class="dataTables_empty">رکوردی با این مشخصات پیدا نشد</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>

        <div class="card-footer pb-0">
            <div class="d-flex justify-content-end">
                {{ $groups->links('vendor.livewire.custom-pagination-view') }}
            </div>
        </div>
    </div>

    @include('livewire.support.group.edit-group-offcanvas')

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
            enforceWhitelist: false,
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


        window.addEventListener('livewire:initialized', () => {
            Livewire.on('get-oldMembers', ({data}) => {
                TagifyUserList.addTags(data);
            })
        })

        var myOffcanvas = document.getElementById('offcanvasEnd')
        myOffcanvas.addEventListener('hidden.bs.offcanvas', function () {
            TagifyUserList.removeAllTags();
        })

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

    <script>
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('show-edit-form', () => {
                $('#offcanvasEnd').offcanvas('show');
            })

            Livewire.on('hide-edit-form', () => {
                $('#offcanvasEnd').offcanvas('hide');
            })
        })
    </script>

@endsection
