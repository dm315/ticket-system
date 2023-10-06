<div class="modal fade show" id="changeStatus" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form wire:submit="changeStatus">
                <div class="modal-body">

                    <label for="status" class="form-label">{{ $type == 0 ? 'تسک' : 'پروژه' }} شما درچه مرحله/وضعیتی
                        می‌باشد؟!
                    </label>
                    <div wire:ignore>
                        <select id="status"
                                wire:model="status_id"
                                class="selectpicker w-100 @error('status_id') border-error @enderror"
                                data-style="btn-default">
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('priority')
                    <div class="w-100 text-center">
                        <small class="badge bg-label-youtube fw-bold">{{ $message }}</small>
                    </div>
                    @enderror


                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">ثبت تغییر</button>
                </div>
            </form>
        </div>
    </div>
</div>
