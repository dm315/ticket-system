<div class="col-xl-4 col-lg-6 col-md-6">
    <div class="card" @style(['opacity:.5' => $role->status === 0])>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h6 class="fw-normal">مجموعا {{ $role->users->count() }} کاربر</h6>
                <ul class="list-unstyled d-flex align-items-center avatar-group mb-0" wire:ignore>
                    @foreach($role->users as $user)
                        <li
                            data-bs-toggle="tooltip"
                            data-popup="tooltip-custom"
                            data-bs-placement="top"
                            title="{{ $user->fullName }}"
                            class="avatar avatar-sm pull-up"
                        >
                            @if($user->profile)
                                <img src="{{ asset($user->profile) }}" alt="Avatar"
                                     class="rounded-circle">
                            @else
                                {!! avatar($user->fName, $user->lName) !!}
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="d-flex justify-content-between align-items-end">
                <div class="role-heading">
                    <h4 class="mb-1">{{ $role->persian_name }}</h4>
                    <a
                        wire:click="$dispatch('show-edit-role-modal', {role: {{ $role }} })"
                        role="button"
                        type="button"
                        class="role-edit-modal text-primary"
                    ><small>ویرایش نقش</small>
                    </a>
                </div>
                <div>
                    @if($role->status == 1)
                        <a role="button" type="button" class="text-muted"
                           wire:click="changeStatus"
                           data-bs-toggle="tooltip"
                           data-popup="tooltip-custom"
                           data-bs-placement="top"
                           title="تغییر وضعیت"
                        >
                            <i class='bx bx-show-alt'></i>

                        </a>
                    @else
                        <a role="button"
                           wire:click="changeStatus"
                           type="button" class="text-muted"
                           data-bs-toggle="tooltip"
                           data-popup="tooltip-custom"
                           data-bs-placement="top"
                           title="تغییر وضعیت"
                        >
                            <i class='bx bx-hide bx-flip-horizontal'></i>
                        </a>
                    @endif
                    <a role="button" type="button"
                       wire:click="$parent.showConfirmDelete({{ $role->id }})"
                       class="text-muted"><i
                            class="bx bx-trash"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
