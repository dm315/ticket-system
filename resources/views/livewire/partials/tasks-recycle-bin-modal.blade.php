<div class="modal modal-top fade" id="modalTop" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">تسک های حذف شده</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">

                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th>عنوان</th>
                                <th>نوع</th>
                                <th>الویت</th>
                                <th>تاریخ ایجاد</th>
                                <th>مهلت انجام</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @forelse($removedTasks as $removedTask)
                                <tr wire:key="{{ $removedTask->id }}">
                                    <td>
                                        <span class="emp_name text-truncate">{{ $removedTask->subject }}</span>
                                    </td>
                                    <td>
                                        @if($removedTask->type == 0)
                                            <span class="fw-bold badge bg-label-vimeo">وظیفه</span>
                                        @else
                                            <span class="fw-bold badge bg-label-primary">نامه</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($removedTask->priority == 0)
                                            <span class="fw-bold {{  randomBadge() }}">عادی</span>
                                        @elseif($removedTask->priority == 1)
                                            <span class="fw-bold {{ randomBadge() }}">لحظه ای</span>
                                        @else
                                            <span class="fw-bold {{ randomBadge() }}">آنی</span>
                                        @endif
                                    </td>
                                    <td>{{ jalaliDate($removedTask->created_at, "%d %B %Y , H:i") }}</td>
                                    <td>
                                        @if(dayCount(null,$removedTask->due_date) > 0)
                                            {{ dayCount(null,$removedTask->due_date) }} روز
                                        @else
                                            <span class="badge bg-label-secondary fw-bold">منقــضی شده</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button wire:click.prevent="forceDelete({{ $removedTask->id }})" type="button"
                                                class="btn btn-sm btn-label-youtube ">
                                            <i class="bx bxs-trash-alt me-1"></i>
                                            حذف کامل

                                        </button>

                                        <button type="button" wire:click.prevent="restore({{ $removedTask->id }})"
                                                class="btn btn-sm btn-label-warning"
                                                dideo-checked="true">
                                            <i class="fas fa-trash-arrow-up me-1"></i>
                                            بازیابی

                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr class="odd text-center">
                                    <td colspan="5" class="dataTables_empty">رکوردی با این مشخصات پیدا
                                        نشد
                                    </td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                    بستن
                </button>
            </div>
        </form>
    </div>
</div>
