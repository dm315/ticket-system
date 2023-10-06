<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex align-items-start">
                <div class="d-flex align-items-start">
                    <div class="avatar me-3">
                        <img
                            src="{{ asset($project->logo) }}"
                            alt="لولگوی پروژه"
                            class="rounded-circle"
                            style="object-fit: cover"
                        />
                    </div>
                    <div class="me-2">
                        <h5 class="mb-1"><span class="h5">{{ $project->title }}</span></h5>
                        <div class="client-info d-flex align-items-center">
                            <h6 class="mb-0 me-1">مشـــتری:</h6>
                            <span>{{ $project->client }}</span>
                        </div>
                    </div>
                </div>
                <div class="ms-auto">
                    <div class="dropdown zindex-2">
                        <button
                            type="button"
                            class="btn dropdown-toggle hide-arrow p-0"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a href="{{ route('dashboard.projects.edit', $project) }}" class="dropdown-item">ویرایش
                                    پروژه
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                   wire:click.prevent="$parent.showChangeStatusModal({{ $project->id }})"
                                   role="button" type="button">
                                    تغییر وضعیت
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider"/>
                            </li>
                            <li><a class="dropdown-item text-danger" role="button"
                                   wire:click.prevent="showConfirmDelete" type="button">حذف پروژه</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="d-flex align-items-center justify-content-between">
                <div class="mb-3">
                    <h6 class="mb-2">تاریخ ثبت: <span
                            class="text-body fw-normal">{{ jalaliDate($project->created_at) }}</span></h6>
                    <h6 class="mb-1">تاریخ مهلت: <span
                            class="text-body fw-normal">{{ jalaliDate($project->end_date) }}</span></h6>
                </div>
                <div class="bg-lighter p-2 rounded mb-3">
                    <span>بودجه پروژه:</span>
                    <h6 class="mb-1">{{ priceFormat($project->price) }} تومان</h6>

                </div>
            </div>
            <p class="mb-0">{{ $project->description }}</p>
        </div>
        <div class="card-body border-top">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <div class="flex-shrink-0">
                    @foreach($project->medias as $media)
                        <a role="button" wire:key="{{ $media->id }}" class="cursor-pointer"
                           wire:click="$dispatch('show-gallery-modal', {medias : {{ $project->medias }}, title: '{{ $project->title }}'})"
                        >
                            <img src="{{ asset($media->file) }}" alt="" class="rounded" height="40">
                        </a>
                    @endforeach
                </div>
                <div class="d-flex align-items-center mb-3">
                    <span
                        class="badge bg-label-success ms-auto">{{ dayCount(now(),$project->end_date) }} روز مانده</span>
                </div>
            </div>
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <ul class="list-unstyled d-flex align-items-center avatar-group mb-0 zindex-2">
                        <li
                            data-bs-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-bs-placement="top"
                            title="{{ $project->group->name }}"
                            class="avatar avatar-sm pull-up"
                        >
                            @if($project->group->image)
                                <img class="rounded-circle" style="object-fit: cover"
                                     src="{{ asset($project->group->image) }}"/>
                            @else
                                {!! avatar($project->group->name) !!}
                            @endif
                        </li>
                        <li class="ms-2">
                            <span>نام سرگروه:</span>
                            <small class="text-muted">{{ $project->group->groupLeader->fullName }}</small>
                        </li>

                    </ul>
                </div>
                <div class="text-end">
                    <span class="{{ randomBadge() }} rounded-pill">{{ $project->status->title ?? null }}</span>
                </div>
            </div>
        </div>
    </div>

</div>
