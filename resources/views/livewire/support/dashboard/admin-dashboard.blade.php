@php use Illuminate\Support\Str; @endphp
<div>

    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>تعداد کل تسک ها</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $allTasksCount }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-primary rounded p-2">
                          <i class="fa-solid fa-envelopes-bulk"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>خــوانده شــده</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $tasksReadCount }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-dribbble rounded p-2">
                          <i class="fa-solid fa-envelopes-bulk"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>در انتظار</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $pendingTasks->total() }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-google-plus rounded p-2">
                          <i class="fa-solid fa-envelopes-bulk"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>بایـــگانــی</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $archivedTasksCount }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-linkedin rounded p-2">
                          <i class="fa-solid fa-envelopes-bulk"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>تعداد کل پروژه ها</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $projectsCount }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-vimeo rounded p-2">
                          <i class='bx bx-sitemap'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>انجام شــده</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $completedProjectsCount }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-success rounded p-2">
                          <i class='bx bx-sitemap'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>در حال انجام</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $onGoingProjects->total() }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-warning rounded p-2">
                          <i class='bx bx-sitemap'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-start justify-content-between">
                        <div class="content-left">
                            <span>منقضی شده</span>
                            <div class="d-flex align-items-end mt-2">
                                <h4 class="mb-0 me-2">{{ $expiredProjectsCount }}</h4>
                            </div>
                        </div>
                        <span class="badge bg-label-youtube rounded p-2">
                          <i class='bx bx-task-x'></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-1 mb-4">
        <div class="col-md-6 col-lg-6 mb-md-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2"> <span class="badge bg-label-primary rounded p-2">
                          <i class="fa-solid fa-envelopes-bulk"></i>
                        </span> آخرین تسک های در انتظار</h5>
                    <small class="fw-bold card-subtitle bg-label-dark rounded-1 p-1">{{ $pendingTasks->total() }} تسک در
                        انتظار</small>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>نوع</th>
                            <th>ایجاد کننده</th>
                            <th>مهلت انجام</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($pendingTasks as $task)
                            <tr wire:key="{{ $task->id }}" class="cursor-pointer">
                                <td>
                                    <a href="{{ route('dashboard.tasks.sent', ['search' => $task->subject]) }}"
                                       class="text-body">
                                        {{ $loop->iteration }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.tasks.sent', ['search' => $task->subject]) }}"
                                       class="text-body">
                                    {{ Str::limit($task->subject,27) }}</td>
                                </a>
                                <td>
                                    <a href="{{ route('dashboard.tasks.sent', ['search' => $task->subject]) }}"
                                       class="text-body">
                                        @if($task->type == 0)
                                            <span class="fw-bold badge bg-label-primary">نامه</span>
                                        @else
                                            <span class="fw-bold badge bg-label-vimeo">وظیفه</span>
                                        @endif
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.tasks.sent', ['search' => $task->subject]) }}"
                                       class="text-body">
                                        <small class="fw-semibold">{{ $task->owner()->fullName ?? '' }}</small>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.tasks.sent', ['search' => $task->subject]) }}"
                                       class="text-body">
                                    <span
                                        class="{{ randomBadge() }} rounded-pill">{{ dayCount(null,$task->due_date) }} روز</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5" class="">فعلا تسک در انتظاری نداریم :)</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="col-sm-12 col-md-6">
                        {{ $pendingTasks->links('vendor.livewire.custom-pagination-view') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-6 mb-md-0 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title m-0 me-2"><span class="badge bg-label-info rounded p-2">
                          <i class='bx bx-sitemap'></i>
                        </span> آخرین پروژه های درحال انجام</h5>
                    <small class="fw-bold card-subtitle bg-label-dark rounded-1 p-1"> {{ $onGoingProjects->total() }}
                        پروژه درحال انجام </small>
                </div>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>عنوان</th>
                            <th>نام درخواست دهنده</th>
                            <th>بودجه</th>
                            <th>مهلت تحویل</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($onGoingProjects as $project)
                            <tr wire:key="{{ $project->id }}">
                                <td>
                                    <a href="{{ route('dashboard.projects.index', ['search' => $project->title]) }}"
                                       class="text-body">
                                        {{ $loop->iteration }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.projects.index', ['search' => $project->title]) }}"
                                       class="text-body">
                                        {{ Str::limit($project->title,27) }}
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.projects.index', ['search' => $project->title]) }}"
                                       class="text-body">
                                        <small class="fw-semibold">{{ $project->client }}</small>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.projects.index', ['search' => $project->title]) }}"
                                       class="text-body">
                                        <small>{{ priceFormat($project->price) }} تومان</small>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('dashboard.projects.index', ['search' => $project->title]) }}"
                                       class="text-body">
                                    <span
                                        class="{{ randomBadge() }} rounded-pill">{{ dayCount(null,$project->end_date) }} روز</span>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr class="text-center">
                                <td colspan="5" class="">فعلا پروژه درحال انجامی نداریم :)</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="pt-4 pe-3">
                        <div>
                            {{ $onGoingProjects->links('vendor.livewire.custom-pagination-view') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
