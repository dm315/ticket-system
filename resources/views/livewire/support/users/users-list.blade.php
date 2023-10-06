@php use App\Models\User; @endphp
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}"/>
@endsection


<section>

    <div class="mb-3 ms-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="h5">کاربران</a>
                </li>
                <li class="breadcrumb-item active h5">لیست کاربران</li>
            </ol>
        </nav>
    </div>


    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center"><h5 class="card-title mb-0">لیست کــــاربران</h5></div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons flex-wrap">

                            <button type="button" wire:click.prevent="recycleBin"
                                    class="btn btn-label-facebook me-2" tabindex="0"><span><i
                                        class="fas fa-trash-arrow-up"></i> <span class="d-none d-sm-inline-block">سطل زباله ({{ User::onlyTrashed()->count() }})</span></span>
                            </button>

                            <a href="{{ route('dashboard.users.add') }}"
                               class="btn btn-secondary create-new btn-primary" tabindex="0"><span><i
                                        class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">افزودن کاربر جدید</span></span>
                            </a>


                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 d-flex justify-content-start">
                        <div class="dataTables_length" id="DataTables_Table_0_length"><label>نمایش
                                <select
                                    wire:model.live="perPage"
                                    class="form-select form-select-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="75">75</option>
                                    <option value="100">100</option>
                                </select>
                                ردیف
                            </label>
                        </div>

                        <div class="dataTables_length ms-5" id="DataTables_Table_0_length"><label>
                                نوع کاربر:
                                <select
                                    wire:model.live="user_type"
                                    class="form-select form-select-sm">
                                    <option value="">همه</option>
                                    <option value="0">کاربر</option>
                                    <option value="1">ادمین</option>
                                    <option value="2">سوپر ادمین</option>
                                </select>
                            </label>
                        </div>


                    </div>
                    <div class="col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                        <div id="DataTables_Table_0_filter" class="dataTables_filter"><label>جستجو:
                                <input
                                    wire:model.live.debounce.450ms="search"
                                    type="search"
                                    class="form-control form-control-sm"
                                    placeholder=""
                                />
                            </label>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0"
                       aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr>


                        @include('livewire.partials.table-sortable-th-head',['name' => 'fName', 'displayName' => 'نام کــاربر'])
                        @include('livewire.partials.table-sortable-th-head',['name' => 'email', 'displayName' => 'پست الکترونیک'])
                        @include('livewire.partials.table-sortable-th-head',['name' => 'birth', 'displayName' => 'تاریخ تولد'])
                        @include('livewire.partials.table-sortable-th-head',['name' => 'mobile', 'displayName' => 'شماره تماس'])
                        @include('livewire.partials.table-sortable-th-head',['name' => 'user_type', 'displayName' => 'وضعیت'])

                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="عملیات">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($users  as $key => $user)

                        <tr class="{{ $key % 2 == 0 ? 'even' : 'odd' }}" wire:key="{{ $user->id }}">
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="avatar-wrapper">
                                        <div class="avatar me-2">
                                            @if($user->profile)
                                                <img src="{{ asset($user->profile) }}" alt="پروفایل کاربر"
                                                     class="rounded-circle" style="object-fit: contain">
                                            @else
                                                {!! avatar($user->fName, $user->lName) !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column">
                                    <span
                                        class="emp_name text-truncate">{{ $user->fullName }}
                                    </span>
                                        <small
                                            class="emp_post text-truncate text-muted">{{ $user->position }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->birth }}</td>
                            <td>0{{ $user->mobile }}</td>
                            <td>
                                @if($user->user_type == 2)
                                    <span class="badge bg-label-vimeo fw-bold">
                                        <i class="fa-solid fa-user-tie"></i>
                                        سوپــــر ادمین
                                    </span>
                                @else
                                    <label class="switch switch-info">
                                        <input type="checkbox"
                                               value="{{ $user->user_type }}"
                                               wire:change="changeStatus({{ $user }},$event.target.value)"
                                               class="switch-input" @checked($user->user_type == 1) >
                                        <span class="switch-toggle-slider">
                                        <span class="switch-on">
                                          <i class='bx bx-user-check'></i>
                                        </span>
                                        <span class="switch-off">
                                          <i class="bx bx-user-x"></i>
                                        </span>
                                      </span>
                                        <span
                                            class="switch-label">{{ $user->user_type == 0 ? 'کاربر' : 'ادمین' }}</span>
                                    </label>
                                @endif

                            </td>

                            <td>
                                <button wire:click.prevent="showConfirmDelete({{ $user->id }})" type="button"
                                        class="btn btn-sm btn-label-youtube btn-icon">
                                    <i class="bx bxs-trash-alt"></i>
                                </button>

                                <a href="{{ route('dashboard.users.edit',$user) }}"
                                   class="btn btn-sm btn-label-primary btn-icon item-edit" dideo-checked="true"><i
                                        class="bx bxs-edit"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr class="odd text-center">
                            <td valign="top" colspan="7" class="dataTables_empty">رکوردی با این مشخصات پیدا نشد</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            نمایش 1 تا {{ $perPage }} از {{ $users->count() }} کاربر
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {{ $users->links('vendor.livewire.custom-pagination-view') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.partials.users-recycle-bin-modal')

</section>


@section('script')
    <script>
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('show-recycleBin', () => {
                $('#modalTop').modal('show');
            })
        })
    </script>
@endsection


