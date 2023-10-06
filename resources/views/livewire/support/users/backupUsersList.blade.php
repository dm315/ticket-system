@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}"/>
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}"/>
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
            <table class="datatables-basic table border-top" id="usersList">
                <thead>
                <tr>
                    <th></th>
                    <th></th>
                    <th>#</th>
                    <th>نام کاربر</th>
                    <th>پست الکترونیک</th>
                    <th>تاریخ تولد</th>
                    <th>شماره تماس</th>
                    <th>وضعیت</th>
                    <th class="text-center">عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr wire:key="{{ $user->id }}">
                        <td></td>
                        <td style="width: 0 !important;"></td>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex justify-content-start align-items-center user-name">
                                <div class="avatar-wrapper">
                                    <div class="avatar me-2">
                                        @if($user->profile)
                                            <img src="{{ asset($user->profile) }}" alt="پروفایل کاربر"
                                                 class="rounded-circle">
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
                        <td>{{ $user->mobile }}</td>
                        <td>
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
                                <span class="switch-label">{{ $user->user_type == 0 ? 'کاربر' : 'ادمین' }}</span>
                            </label>

                        </td>

                        <td>
                            <button wire:click.prevent="showConfirmDelete({{ $user->id }})" type="button"
                                    class="btn btn-sm btn-label-youtube btn-icon">
                                <i class="bx bxs-trash-alt"></i>
                            </button>

                            <a href="" class="btn btn-sm btn-label-primary btn-icon item-edit" dideo-checked="true"><i
                                    class="bx bxs-edit"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal to add new record -->
    {{--    <div class="offcanvas offcanvas-end" id="add-new-record">--}}
    {{--        <div class="offcanvas-header border-bottom">--}}
    {{--            <h5 class="offcanvas-title" id="exampleModalLabel">New Record</h5>--}}
    {{--            <button--}}
    {{--                type="button"--}}
    {{--                class="btn-close text-reset"--}}
    {{--                data-bs-dismiss="offcanvas"--}}
    {{--                aria-label="Close"--}}
    {{--            ></button>--}}

    {{--        </div>--}}
    {{--        <div class="offcanvas-body flex-grow-1">--}}
    {{--            <form class="add-new-record pt-0 row g-2" id="form-add-new-record" onsubmit="return false">--}}
    {{--                <div class="col-sm-12">--}}
    {{--                    <label class="form-label" for="basicFullname">Full Name</label>--}}
    {{--                    <div class="input-group input-group-merge">--}}
    {{--                        <span id="basicFullname2" class="input-group-text"><i class="bx bx-user"></i></span>--}}
    {{--                        <input--}}
    {{--                            type="text"--}}
    {{--                            id="basicFullname"--}}
    {{--                            class="form-control dt-full-name"--}}
    {{--                            name="basicFullname"--}}
    {{--                            placeholder="John Doe"--}}
    {{--                            aria-label="John Doe"--}}
    {{--                            aria-describedby="basicFullname2"--}}
    {{--                        />--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-sm-12">--}}
    {{--                    <label class="form-label" for="basicPost">Post</label>--}}
    {{--                    <div class="input-group input-group-merge">--}}
    {{--                        <span id="basicPost2" class="input-group-text"><i class="bx bxs-briefcase"></i></span>--}}
    {{--                        <input--}}
    {{--                            type="text"--}}
    {{--                            id="basicPost"--}}
    {{--                            name="basicPost"--}}
    {{--                            class="form-control dt-post"--}}
    {{--                            placeholder="Web Developer"--}}
    {{--                            aria-label="Web Developer"--}}
    {{--                            aria-describedby="basicPost2"--}}
    {{--                        />--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-sm-12">--}}
    {{--                    <label class="form-label" for="basicEmail">Email</label>--}}
    {{--                    <div class="input-group input-group-merge">--}}
    {{--                        <span class="input-group-text"><i class="bx bx-envelope"></i></span>--}}
    {{--                        <input--}}
    {{--                            type="text"--}}
    {{--                            id="basicEmail"--}}
    {{--                            name="basicEmail"--}}
    {{--                            class="form-control dt-email"--}}
    {{--                            placeholder="john.doe@example.com"--}}
    {{--                            aria-label="john.doe@example.com"--}}
    {{--                        />--}}
    {{--                    </div>--}}
    {{--                    <div class="form-text">You can use letters, numbers & periods</div>--}}
    {{--                </div>--}}
    {{--                <div class="col-sm-12">--}}
    {{--                    <label class="form-label" for="basicDate">Joining Date</label>--}}
    {{--                    <div class="input-group input-group-merge">--}}
    {{--                        <span id="basicDate2" class="input-group-text"><i class="bx bx-calendar"></i></span>--}}
    {{--                        <input--}}
    {{--                            type="text"--}}
    {{--                            class="form-control dt-date"--}}
    {{--                            id="basicDate"--}}
    {{--                            name="basicDate"--}}
    {{--                            aria-describedby="basicDate2"--}}
    {{--                            placeholder="MM/DD/YYYY"--}}
    {{--                            aria-label="MM/DD/YYYY"--}}
    {{--                        />--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-sm-12">--}}
    {{--                    <label class="form-label" for="basicSalary">Salary</label>--}}
    {{--                    <div class="input-group input-group-merge">--}}
    {{--                        <span id="basicSalary2" class="input-group-text"><i class="bx bx-dollar"></i></span>--}}
    {{--                        <input--}}
    {{--                            type="number"--}}
    {{--                            id="basicSalary"--}}
    {{--                            name="basicSalary"--}}
    {{--                            class="form-control dt-salary"--}}
    {{--                            placeholder="12000"--}}
    {{--                            aria-label="12000"--}}
    {{--                            aria-describedby="basicSalary2"--}}
    {{--                        />--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="col-sm-12">--}}
    {{--                    <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Submit</button>--}}
    {{--                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="offcanvas">Cancel</button>--}}
    {{--                </div>--}}
    {{--            </form>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <!-- DataTable with Buttons -->

</section>


@section('script')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script src="{{ asset('assets/js/customs/users-list-table.js') }}"></script>
@endsection
