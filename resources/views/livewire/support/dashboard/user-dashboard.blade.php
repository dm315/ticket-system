@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}"/>
@endsection

<div>

    <div class="row mt-4">
        <div class="col-12">
            <div class="card mb-4">
                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                    <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                        <img
                            src="{{ $user->profile ? asset($user->profile) : asset('assets/img/avatars/default.png') }}"
                            alt="{{ $user->fullName }}"
                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img"
                        />
                    </div>
                    <div class="flex-grow-1 mt-3 mt-sm-5">
                        <div
                            class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4"
                        >
                            <div class="user-profile-info">
                                <h4>{{ $user->fullName }}</h4>
                                <ul
                                    class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2"
                                >
                                    <li class="list-inline-item fw-semibold"><i
                                            class="fa-solid fa-id-card-clip me-1"></i> {{ $user->position }}</li>
                                    <li class="list-inline-item "><i class='bx bx-phone bx-rotate-270 me-1'></i>
                                        0{{ $user->mobile }}</li>
                                    <li class="list-inline-item">
                                        <i class="bx bx-calendar-alt me-1"></i> عضو شده
                                        از {{ jalaliDate($user->created_at) }}
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fa-solid fa-cake-candles"></i> تاریخ تولد: {{ $user->bith }}
                                    </li>
                                </ul>
                            </div>
                            <a href="{{ route('dashboard.profile.edit-profile',$user->id) }}" class="btn btn-slack bg-label-primary text-nowrap">
                                <i class="fa-solid fa-user-pen me-1"></i> ویرایش حساب کاربری
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
