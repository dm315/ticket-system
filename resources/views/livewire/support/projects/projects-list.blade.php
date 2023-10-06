@section('style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/animate-css/animate.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}"/>
@endsection


<section>

    <div class="mb-3 ms-2 row">
        <div class="col-sm-12 col-md-9">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style2 mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="javascript:void(0);" class="h5">پــروژه ها</a>
                    </li>
                    <li class="breadcrumb-item active h5">لیست پــروژه ها
                    </li>
                </ol>
            </nav>
        </div>
        <div class="col-sm-12 col-md-3">
            <div class="input-group input-group-merge">
                <span class="input-group-text cursor-pointer" id="basic-addon-search31"><i
                        class="bx bx-search"></i></span>
                <input type="text" class="form-control" wire:model.live.debounce.850ms="search" placeholder="جستجو..."
                       aria-label="Search..."
                       aria-describedby="basic-addon-search31">
            </div>
        </div>
    </div>

    <div class="row g-4">
        @forelse($projects as $project)
            <livewire:support.projects.project-card :key="$project->id" :$project/>
        @empty
            <div class="d-flex justify-content-center">
                <div class="alert alert-gray d-flex mt-5 mb-0 p-4 w-50" role="alert">
                    <a href="{{ route('dashboard.projects.add') }}"
                       class="badge badge-center rounded-pill bg-dark border-label-dark p-3 me-2"><i
                            class="bx bx-plus fs-6"></i></a>
                    <div class="d-flex flex-column ps-1">
                        <h6 class="alert-heading d-flex align-items-center fw-bold mb-1">پروژه ای یافت نشد!!</h6>
                        <span>با کلیک بر روی علامت + یا از منوی سمت راست پروژه مورد نظر خود را تعریف کنید!</span>
                    </div>
                </div>
            </div>
        @endforelse
    </div>


    @include('livewire.partials.project-images-gallery-modal')
    @include('livewire.partials.change-status-modal', ['statuses' => $statuses, 'type' => 1])

</section>


@section('script')
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/js/ui-carousel.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script>
        window.addEventListener('livewire:initialized', () => {
            Livewire.on('show-gallery-modal', ({medias, title}) => {
                document.getElementById('txt_title').innerHTML = title;
                var container = document.getElementById('swiper_container');
                var path = window.location.origin;
                medias.map((media, i) => {
                    container.innerHTML += `
                    <div class="swiper-slide rounded-3"
                             style="background-image: url('${path}/${media.file}')">
                    </div>
                    `;
                });
                $('#gallery-modal').modal('show');
            })
            $('#gallery-modal').on('hidden.bs.modal', function () {
                location.reload();
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
