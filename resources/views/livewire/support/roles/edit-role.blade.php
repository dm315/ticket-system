<!-- Edit Role Modal -->
<div class="modal fade" id="editRoleModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-simple modal-dialog-centered modal-edit-new-role">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h4>ویرایش نقش "{{ $persian_name ?? '' }}"</h4>
                    <p>مجــوزهای نقش رو تنظیم کنید!</p>
                </div>
                <!-- edit role form -->
                <form id="editRoleForm" class="row g-3" wire:submit="update">
                    <div class="col-6 mb-1">
                        <label class="form-label" for="persianName">
                            عنوان فارسی نقش
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                            type="text"
                            id="persianName"
                            wire:model="persian_name"
                            class="form-control @error('persian_name') border-error @enderror"
                            placeholder="نام نقش را وارد کنید"
                            tabindex="-1"
                        />
                        @error('persian_name')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>
                    <div class="col-6 mb-1">
                        <label class="form-label" for="title">
                            عنوان لاتین نقش
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                            type="text"
                            id="title"
                            wire:model="title"
                            class="form-control text-end @error('title') border-error @enderror"
                            placeholder="ex. Operator"
                            tabindex="-1"
                        />
                        @error('title')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalRoleName">
                            توضیحات نقــــش
                        </label>
                        <input
                            type="text"
                            id="description"
                            wire:model="description"
                            class="form-control @error('description') border-error @enderror"
                            placeholder="توضیحات نقش را وارد کنید"
                            tabindex="-1"
                        />
                        @error('description')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <h4>مجـــــوز های نقــــش</h4>
                        @error('selectedPermissions')
                        <div class="mb-3">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                        <!-- Permission table -->
                        <div class="row">
                            @foreach($permissions as $permission)
                                <div class="col-3" wire:key="{{ $permission->id }}">
                                    <div class="form-check me-2 mb-3">
                                        <input
                                            class="form-check-input @error('selectedPermissions') border-error @enderror"
                                            type="checkbox"
                                            id="{{ $permission->id }}"
                                            value="{{ $permission->id }}"
                                            @checked(in_array($permission->id,$selectedPermissions))
                                            wire:model="selectedPermissions"
                                        >
                                        <label class="form-check-label"
                                               for="{{ $permission->id }}">{{ $permission->persian_name }}</label>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <!-- Permission table -->
                    </div>
                    <div class="col-12 text-center">
                        <button
                            type="button"
                            class="btn btn-label-secondary"
                            data-bs-dismiss="modal" aria-label="Close"
                        >
                            انصراف
                        </button>
                        <button type="submit" class="btn btn-primary ms-sm-3 ms-1">ثبت</button>

                    </div>
                </form>
                <!--/ edit role form -->
            </div>
        </div>
    </div>
</div>
<!--/ edit Role Modal -->
