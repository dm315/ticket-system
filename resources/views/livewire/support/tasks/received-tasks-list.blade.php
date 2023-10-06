@php use App\Models\tasks\Task; @endphp
@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}"/>
@endsection


<section>

    <div class="mb-3 ms-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="javascript:void(0);" class="h5">تســک ها</a>
                </li>
                <li class="breadcrumb-item active h5">لیست تســک های رسیده</li>
            </ol>
        </nav>
    </div>


    <!-- DataTable with Buttons -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
                    <div class="head-label text-center"><h5 class="card-title mb-0">لیست تســــک های دریافت شده</h5>
                    </div>
                    <div class="dt-action-buttons text-end pt-3 pt-md-0">
                        <div class="dt-buttons flex-wrap">

                            <button type="button" wire:click.prevent="recycleBin"
                                    class="btn btn-label-facebook me-2" tabindex="0"><span><i
                                        class="fas fa-trash-arrow-up"></i> <span class="d-none d-sm-inline-block">سطل زباله ({{ Task::onlyTrashed()->count() }})</span></span>
                            </button>

                            <a href="{{ route('dashboard.tasks.add') }}"
                               class="btn btn-secondary create-new btn-primary" tabindex="0"><span><i
                                        class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">افزودن تســک جدید</span></span>
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
                                نوع تســـک:
                                <select
                                    wire:model.live="task_type"
                                    class="form-select form-select-sm">
                                    <option value="">همه</option>
                                    <option value="0">وظیفه</option>
                                    <option value="1">نامه</option>
                                </select>
                            </label>
                        </div>
                        <div class="dataTables_length ms-5" id="DataTables_Table_0_length"><label>
                                الویت تســـک:
                                <select
                                    wire:model.live="priority_type"
                                    class="form-select form-select-sm">
                                    <option value="">همه</option>
                                    <option value="0">عادی</option>
                                    <option value="1">لحظه ای</option>
                                    <option value="2">آنی</option>
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
                                    placeholder="بر اساس شناسه و عنوان..."
                                />
                            </label>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0"
                       aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr>
                        @include('livewire.partials.table-sortable-th-head',['name' => 'subject', 'displayName' => 'عنوان'])
                        @include('livewire.partials.table-sortable-th-head',['name' => 'type', 'displayName' => 'نوع'])
                        <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">ایجاد کننده</th>
                        @include('livewire.partials.table-sortable-th-head',['name' => 'priority', 'displayName' => 'الویت'])
                        <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">اختصاص به</th>
                        @include('livewire.partials.table-sortable-th-head',['name' => 'created_at', 'displayName' => 'تاریخ ایجاد'])
                        @include('livewire.partials.table-sortable-th-head',['name' => 'due_date', 'displayName' => 'مهلت انجام'])
                        <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">وضعیت</th>
                        <th tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($tasks as $key => $task)

                        <tr class="{{ $key % 2 == 0 ? 'even' : 'odd' }}" wire:key="{{ $task->id }}">
                            <td>
                                <span class="emp_name text-truncate">{{ $task->subject }}</span>
                            </td>
                            <td>
                                @if($task->type == 0)
                                    <span class="fw-bold badge bg-label-primary">نامه</span>
                                @else
                                    <span class="fw-bold badge bg-label-vimeo">وظیفه</span>
                                @endif
                            </td>
                            <td>{{ $task->owner()->fullName ?? '' }}</td>
                            <td>
                                @if($task->priority == 0)
                                    <span class="fw-bold {{  randomBadge() }}">عادی</span>
                                @elseif($task->priority == 1)
                                    <span class="fw-bold {{ randomBadge() }}">لحظه ای</span>
                                @else
                                    <span class="fw-bold {{ randomBadge() }}">آنی</span>
                                @endif
                            </td>
                            <td>
                                <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">

                                    @foreach($task->users()->where('is_owner', 0)->get() as $user)
                                        <li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top"
                                            class="avatar avatar-xs pull-up" aria-label="{{ $user->fullName }}"
                                            data-bs-original-title="{{ $user->fullName }}">
                                            @if($user->profile)
                                                <img src="{{ asset($user->profile) }}" alt="Avatar"
                                                     class="rounded-circle">
                                            @else
                                                {!! avatar($user->fName, $user->lName) !!}
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ jalaliDate($task->created_at, "%d %B %Y , H:i") }}</td>
                            <td>
                                @if(dayCount(null,$task->due_date) > 0)
                                    {{ dayCount(null,$task->due_date) }} روز
                                @else
                                    <span class="badge bg-label-secondary fw-bold">منقــضی شده</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold {{ randomBadge() }}">{{ $task->status->title ?? '' }}</span>
                            </td>
                            <td>
                                <button type="button"
                                        class="btn btn-sm btn-icon rounded-pill dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" style="">
                                    <li><a class="dropdown-item" href="{{ route('dashboard.tasks.edit', $task) }}">
                                            <i class="bx bxs-edit"></i> ویرایش</a></li>
                                    <li><a class="dropdown-item" role="button" type="button"> <i
                                                class="fa-regular fa-eye"></i> جزییات</a></li>
                                    <li>
                                        <a class="dropdown-item"
                                           wire:click.prevent="showChangeStatusModal({{ $task->id }})"
                                           role="button" type="button">
                                            <i class="fa-solid fa-rotate"></i>
                                            تغییر وضعیت
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a role="button" type="button"
                                           wire:click.prevent="showConfirmDelete({{ $task->id }})"
                                           class="dropdown-item text-danger"><i
                                                class="bx bxs-trash-alt"></i> حذف</a></li>
                                </ul>
                            </td>
                        </tr>
                    @empty
                        <tr class="odd text-center">
                            <td colspan="8" class="dataTables_empty">رکوردی با این مشخصات پیدا نشد</td>
                        </tr>

                    @endforelse

                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">
                            نمایش 1 تا {{ $perPage }} از {{ $tasks->count() }} تسک
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {{ $tasks->links('vendor.livewire.custom-pagination-view') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ DataTable with Buttons -->

    @include('livewire.partials.tasks-recycle-bin-modal')
    @include('livewire.partials.change-status-modal', ['statuses' => $statuses, 'type' => 0])
</section>

@section('script')
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script>
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('show-recycleBin', () => {
                $('#modalTop').modal('show');
            })

            Livewire.on('show-changeStatus', () => {
                $('#changeStatus').modal('show');
            })
            Livewire.on('hide-changeStatus', () => {
                $('#changeStatus').modal('hide');
            })
        })
    </script>
@endsection
