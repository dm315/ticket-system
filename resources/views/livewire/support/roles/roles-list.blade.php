@php use Carbon\Carbon;use Illuminate\Support\Str; @endphp
<div>


    <div class="mb-3 ms-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item active h5">لیست نقش ها</li>
            </ol>
        </nav>
    </div>

    <h4 class="fw-bold py-3 mb-2">لیست نقــــش ها</h4>

    <p>
        یک نقش دسترسی به منوها و ویژگی های از پیش تعریف شده را فراهم می کند به طوری که بسته به نقش تعیین شده , <br/>
        مدیر بتواند به آنچه کاربر نیاز دارد دسترسی داشته باشد.
        <sup class="fw-bold">( جواد خیابانی )</sup>
    </p>
    <div class="divider text-start">
        <div class="divider-text">
            <i class="bx bx-user-pin"></i>
        </div>
    </div>

    <div class="row g-4">
        @foreach($roles as $role)
            <livewire:support.roles.role-card :key="$role->id" :$role/>
        @endforeach

        <div class="col-xl-4 col-lg-6 col-md-6">
            <div class="card h-100">
                <div class="row h-100">
                    <div class="col-sm-5">
                        <div class="d-flex align-items-end h-100 justify-content-center mt-sm-0 mt-3">
                            <img src="{{ asset('assets/img/illustrations/boy-with-laptop-dark.png') }}"
                                 class="img-fluid"
                                 alt="Image" width="120"
                                 data-app-light-img="illustrations/boy-with-laptop-light.png"
                                 data-app-dark-img="illustrations/boy-with-laptop-dark.png">
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="card-body text-sm-end text-center ps-sm-0">
                            <button wire:click="$dispatch('show-create-role-form')"
                                    class="btn btn-primary mb-3 text-nowrap add-new-role">
                                افزودن نقش جدید
                            </button>
                            <small class="mb-0 d-block">نقش مورد نظرت نیست؟ اضافه‌ش کن</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <livewire:support.roles.add-role key="{{ Str::random() . '-' . Carbon::now()->timestamp  }}"/>
    <livewire:support.roles.edit-role key="{{ Str::random() . '-' . Carbon::now()->timestamp }}"/>
</div>


@section('script')
    <script>
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('show-create-role-form', () => {
                $('#addRoleModal').modal('show');
            })
            Livewire.on('hide-create-role-form', () => {
                $('#addRoleModal').modal('hide');
            })

            Livewire.on('show-edit-role-modal', () => {
                $('#editRoleModal').modal('show');
            })
            Livewire.on('hide-edit-role-modal', () => {
                $('#editRoleModal').modal('hide');
            })
        })
        window.addEventListener('scroll', () => {
            if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                @this.
                loadMore();
            }
        })
    </script>
@endsection
