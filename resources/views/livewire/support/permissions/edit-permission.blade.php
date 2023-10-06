<div class="modal fade" id="editPermissionModal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-dialog-centered modal-simple">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>ویرایش مجوز "{{ $persian_name ?? '' }}"</h3>
                    <p>ویرایش مجوز بر اساس نیاز شما.</p>
                </div>
                <div class="alert alert-warning" role="alert">
                    <h6 class="alert-heading fw-bold mb-2">اخـــطار</h6>
                    <p class="mb-0">
                        با ویرایش نام مجوز، ممکن است عملکرد مجوزهای سیستم را خراب کنید. لطفا
                        قبل از ادامه از کار خود مطمئن شوید.
                    </p>
                </div>
                <form id="editPermissionForm" class="row" wire:submit="update">
                    <div class="col-6 mb-1">
                        <label class="form-label" for="persianName">
                            عنوان فارسی مجوز
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                                type="text"
                                id="persianName"
                                wire:model.blur="persian_name"
                                class="form-control @error('persian_name') border-error @enderror"
                                placeholder="نام مجوز را وارد کنید"
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
                            عنوان لاتین مجوز
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                                type="text"
                                id="title"
                                wire:model.blur="title"
                                class="form-control text-end @error('persian_name') border-error @enderror"
                                placeholder="ex. update-post"
                                tabindex="-1"
                        />
                        @error('title')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="col-12 mb-4">
                        <label class="form-label" for="modalPermissionDescription">
                            توضیحات مجـــوز
                        </label>
                        <input
                                type="text"
                                id="modalPermissionDescription"
                                wire:model="description"
                                class="form-control @error('description') border-error @enderror"
                                placeholder="توضیحات مجوز را وارد کنید"
                                tabindex="-1"
                        />
                        @error('description')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>


                    <div class="col-12 text-center demo-vertical-spacing">
                        <button
                            type="reset"
                            class="btn btn-label-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        >
                            بستن
                        </button>
                        <button type="submit" class="btn btn-primary ms-sm-3 me-1">ویرایش مجوز</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
