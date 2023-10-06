<div class="modal fade" id="twoFactorAuth" data-bs-backdrop="static" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg modal-dialog-centered modal-simple">
        <div class="modal-content p-3">
            <div class="modal-body">
                <!--  Two Steps Verification -->
                <div class="">
                    <div class="card-body">
                        <h4 class="mb-2">تایید دو مرحله ای 📧</h4>
                        <p class="text-start mb-4">
                            ما یک کد تأیید به پست الکترونیک شما ارسال کردیم. کد را در فیلد زیر وارد کنید.
                            <span class="fw-bold d-block mt-2">{{ $userEmail }}</span>
                        </p>
                        <p class="mb-0 fw-semibold">کد امنیتی 6 رقمی خود را وارد کنید</p>
                        <form id="twoStepsForm" wire:submit="confirmOtpCode">
                            <div class="mb-3">
                                <div
                                    class="d-flex align-items-center justify-content-sm-between numeral-mask-wrapper"
                                    dir="ltr"
                                >
                                    <input
                                        type="text"
                                        class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                                        maxlength="1"
                                        autofocus
                                    />
                                    <input
                                        type="text"
                                        class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                                        maxlength="1"
                                    />
                                    <input
                                        type="text"
                                        class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                                        maxlength="1"
                                    />
                                    <input
                                        type="text"
                                        class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                                        maxlength="1"
                                    />
                                    <input
                                        type="text"
                                        class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                                        maxlength="1"
                                    />
                                    <input
                                        type="text"
                                        class="form-control auth-input h-px-50 text-center numeral-mask text-center h-px-50 mx-1 my-2"
                                        maxlength="1"
                                    />
                                </div>
                                <!-- Create a hidden field which is combined by 3 fields above -->
                                <input type="hidden" id="otpCode" value="">
                            </div>
                            <button class="btn btn-primary d-grid w-100 mb-3"
                                    wire:loading.attr="disabled"
                                    wire:target="resendOtp"
                                    x-on:click="$wire.set('otpCode', document.getElementById('otpCode').value)">تایید
                                پست الکترونیک
                            </button>
                            <div class="text-center">
                                کد را دریافت نکردید؟
                                <a href="javascript:void(0)"
                                   wire:loading.attr="disabled"
                                   wire:target="resendOtp"
                                   role="button" type="button" x-on:click="$wire.resendOtp()">
                                    ارسال مجدد </a>
                            </div>

                            <div class="mt-3" wire:loading wire:loading.class="d-block" wire:target="resendOtp">
                                <div class="sk-wave mx-auto">
                                    <div class="sk-rect sk-wave-rect"></div>
                                    <div class="sk-rect sk-wave-rect"></div>
                                    <div class="sk-rect sk-wave-rect"></div>
                                    <div class="sk-rect sk-wave-rect"></div>
                                    <div class="sk-rect sk-wave-rect"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- / Two Steps Verification -->

            </div>
        </div>
    </div>
</div>
