@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}"/>
@endsection

<div>


    <h4 class="fw-bold py-3 mb-2">لیست سطوح دسترسی
        <sup class="text-gray">مجوز ها</sup>
    </h4>

    <!-- Permission Table -->
    <div class="card">
        <div class="card-datatable table-responsive">
            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                <div class="card-header flex-column flex-md-row">
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
                                وضعیت مجوز:
                                <select
                                        wire:model.live="status"
                                        class="form-select form-select-sm">
                                    <option value="">همه</option>
                                    <option value="0">غیرفعال</option>
                                    <option value="1">فعال</option>
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

                        <div class="dt-action-buttons text-end pt-3 pt-md-0 d-flex align-items-center ms-2">
                            <div class="dt-buttons flex-wrap">
                                <button
                                        wire:click="$dispatch('show-add-permission-form')"
                                        class="btn btn-secondary create-new btn-primary" tabindex="0"><span><i
                                                class="bx bx-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">افزودن مجوز جدید</span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="datatables-basic table border-top dataTable no-footer dtr-column" id="DataTables_Table_0"
                       aria-describedby="DataTables_Table_0_info">
                    <thead>
                    <tr>


                        @include('livewire.partials.table-sortable-th-head',['name' => 'title', 'displayName' => 'عنوان مجوز'])
                        <th
                                tabindex="0"
                                aria-controls="DataTables_Table_0"
                                rowspan="1" colspan="1"
                        >
                            اختصاص به
                        </th>
                        @include('livewire.partials.table-sortable-th-head',['name' => 'description', 'displayName' => 'توضیحات'])
                        @include('livewire.partials.table-sortable-th-head',['name' => 'status', 'displayName' => 'وضعیت'])

                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="عملیات">
                            عملیات
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($permissions  as $key => $permission)

                        <tr class="{{ $key % 2 == 0 ? 'even' : 'odd' }}" wire:key="{{ $permission->id }}">
                            <td>
                                <div class="d-flex justify-content-start align-items-center user-name">
                                    <div class="d-flex flex-column">
                                    <span
                                            class="emp_name text-truncate">{{ $permission->persian_name }}
                                    </span>
                                        <small
                                                class="emp_post text-truncate text-muted">{{ $permission->title }}
                                        </small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @foreach($permission->roles as $role)
                                    <a href="">
                                        <span class="{{ randomBadge() }}">{{ $role->persian_name }}</span>
                                    </a>
                                @endforeach
                            </td>
                            <td>{{ $permission->description }}</td>
                            <td>
                                <label class="switch switch-info">
                                    <input type="checkbox"
                                           value="{{ $permission->status }}"
                                           wire:change="changeStatus({{ $permission }},$event.target.value)"
                                           class="switch-input" @checked($permission->status == 1) >
                                    <span class="switch-toggle-slider">
                            <span class="switch-on">
                              <i class='bx bx-check-circle'></i>
                            </span>
                            <span class="switch-off">
                              <i class='bx bx-x-circle'></i>
                            </span>
                          </span>
                                    <span
                                            class="switch-label">{{ $permission->status == 0 ? 'غیرفعال' : 'فعال' }}</span>
                                </label>
                            </td>

                            <td>
                                <button wire:click="showConfirmDelete({{ $permission->id }})"
                                        class="btn btn-sm btn-icon"><i
                                            class="bx bx-trash"></i></button>

                                <button
                                        wire:click="$dispatch('show-edit-permission-form', {permission: {{ $permission }}})"
                                        class="btn btn-sm btn-icon me-2">
                                    <i class="bx bx-edit"></i>
                                </button>
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
                            نمایش 1 تا {{ $perPage }} از {{ $permissions->total() }} مجوز
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {{ $permissions->links('vendor.livewire.custom-pagination-view') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Permission Table -->

    <!-- Add Permission Modal -->
    <livewire:support.permissions.add-permission/>
    <!--/ Add Permission Modal -->

    <!-- Edit Permission Modal -->
    <livewire:support.permissions.edit-permission/>
    <!--/ Edit Permission Modal -->
</div>



@section('script')
    <script>
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('show-add-permission-form', () => {
                $('#addPermissionModal').modal('show');
            })
            Livewire.on('hide-add-permission-form', () => {
                $('#addPermissionModal').modal('hide');
            })


            Livewire.on('show-edit-permission-form', () => {
                $('#editPermissionModal').modal('show');
            })
            Livewire.on('hide-edit-permission-form', () => {
                $('#editPermissionModal').modal('hide');
            })
        })
    </script>
@endsection
