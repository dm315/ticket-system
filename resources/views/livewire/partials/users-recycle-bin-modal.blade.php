<div class="modal modal-top fade" id="modalTop" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog modal-xl">
        <form class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTopTitle">کاربران حذف شده</h5>
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
                                <th>نام کاربر</th>
                                <th>پست الکترونیک</th>
                                <th>شماره تماس</th>
                                <th>وضعیت</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @forelse($removedUsers as $removedUser)
                                <tr wire:key="{{ $removedUser->id }}">
                                    <td>
                                        <div class="d-flex justify-content-start align-items-center user-name">
                                            <div class="avatar-wrapper">
                                                <div class="avatar me-2">
                                                    @if($removedUser->profile)
                                                        <img src="{{ asset($removedUser->profile) }}"
                                                             alt="پروفایل کاربر"
                                                             class="rounded-circle">
                                                    @else
                                                        {!! avatar($removedUser->fName, $removedUser->lName) !!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="d-flex flex-column">
                                    <span
                                        class="emp_name text-truncate">{{ $removedUser->fullName }}
                                    </span>
                                                <small
                                                    class="emp_post text-truncate text-muted">{{ $removedUser->position }}
                                                </small>
                                            </div>
                                        </div>

                                    </td>
                                    <td>{{ $removedUser->email }}</td>
                                    <td>0{{ $removedUser->mobile }}</td>
                                    <td>
                                        @if($removedUser->user_type == 0)
                                            <span class="badge bg-label-primary me-1">کاربر</span>
                                        @else
                                            <span class="badge bg-label-vimeo me-1">ادمین</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <button wire:click.prevent="forceDelete({{ $removedUser->id }})" type="button"
                                                class="btn btn-sm btn-label-youtube ">
                                            <i class="bx bxs-trash-alt me-1"></i>
                                            حذف کامل

                                        </button>

                                        <button type="button" wire:click.prevent="restore({{ $removedUser->id }})"
                                                class="btn btn-sm btn-label-warning"
                                                dideo-checked="true">
                                            <i class="fas fa-trash-arrow-up me-1"></i>
                                            بازیابی

                                        </button>

                                    </td>
                                </tr>
                            @empty
                                <tr class="odd text-center">
                                    <td colspan="7" class="dataTables_empty">رکوردی با این مشخصات پیدا
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
