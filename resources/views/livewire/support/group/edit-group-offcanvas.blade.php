<div
    wire:ignore.self
    class="offcanvas offcanvas-end"
    tabindex="-1"
    id="offcanvasEnd"
    aria-labelledby="offcanvasEndLabel"
>
    <div class="offcanvas-header">
        <h5 id="offcanvasEndLabel" class="offcanvas-title">ویرایش گروه</h5>
        <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        ></button>
    </div>
    <div class="offcanvas-body my-auto mx-0 flex-grow-0">

        <div class="">

            <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img
                    src="{{ asset($oldImage) }}"
                    alt="user-avatar"
                    class="d-block rounded"
                    height="100"
                    width="100"
                    id="uploadedAvatar"
                />
                <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary btn-sm me-2 mb-2" tabindex="0">
                        <span class="d-none d-sm-block">بارگذاری تصویر لوگو</span>
                        <i class="bx bx-upload d-block d-sm-none"></i>
                        <input
                            type="file"
                            id="upload"
                            class="account-file-input"
                            hidden
                            wire:model="image"
                            accept="image/*"
                        />
                    </label>
                    <button type="button" class="btn btn-label-reddit btn-sm account-image-reset mb-2">
                        <i class="bx bx-reset d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">پاک کردن</span>
                    </button>
                    @error('image')
                    <div class="w-100 text-start mt-2">
                        <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                    </div>
                    @enderror
                    <div class="w-100 text-start mt-2" wire:loading wire:target="image">
                        <small class="badge bg-label-success fw-bold">درحال بارگذاری تصویر...</small>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-2"/>


        <form id="formAccountSettings" wire:submit="update">
            <div>

                <div class="row">
                    <div class="mb-3">
                        <label for="firstName" class="form-label">نام گروه
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                            wire:model="name"
                            class="form-control @error('name') border-error @enderror"
                            type="text"
                            id="firstName"
                            name="firstName"
                            autofocus
                        />
                        @error('name')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3" wire:ignore.self>
                        <label for="parent_id" class="form-label">زیر گـــروه
                        </label>

                        <select id="parent_id"
                                class="select2 form-select @error('parent_id') border-error @enderror">
                            <option disabled>انتخاب زیر گـــروه</option>
                            <option value="">گـــروه اصـــلی</option>
                            @if($parent_groups != null)
                                @foreach($parent_groups as $parent_group)
                                    <option wire:key="{{ $parent_group->id }}"
                                            value="{{ $parent_group->id }}" @selected($parent_group->id == $parent_id)>{{ $parent_group->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('parent_id')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>


                    <div class="mb-3" wire:ignore>
                        <label for="TagifyUserList" class="form-label">افراد مجــموعه
                            <sup class="text-danger">*</sup>
                        </label>
                        <input
                            id="TagifyUserList"
                            name="TagifyUserList"
                            placeholder="افراد گروه خود را انتخاب کنید"
                            class="form-control @error('members') border-error @enderror"
                            required
                        />
                        @error('members')
                        <div class="w-100 text-center">
                            <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>
                </div>
            </div>


            <button type="submit" class="btn btn-gray my-2 d-grid w-100">ویرایش</button>

        </form>
        <button
            type="button"
            class="btn btn-label-secondary d-grid w-100"
            data-bs-dismiss="offcanvas"
        >
            انصراف
        </button>
    </div>
</div>

