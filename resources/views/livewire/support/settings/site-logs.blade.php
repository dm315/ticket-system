<div>

    <div class="mb-3 ms-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style2 mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('dashboard.home') }}" class="h5">خانه</a>
                </li>
                <li class="breadcrumb-item active h5">گزارش وضعیت</li>
            </ol>
        </nav>
    </div>

    <div class="col-12">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">گزارش وضعیت</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>نام ادمین</th>
                        <th>نقش</th>
                        <th>تاریخ انجام فعالیت</th>
                        <th>تغییرات</th>
                        <th class="text-center">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>دانیال مبینی</td>
                        <td>
                            <span class="badge bg-label-google-plus rounded-pill">برنامه نویس</span>
                        </td>
                        <td>
                            1402/06/09 18:04
                        </td>
                        <td>
                            <small class="fw-bold">
                                حذف دسته بندی
                            </small>
                        </td>
                        <td class="text-end">
                            <button type="button" class="btn btn-label-info btn-sm">
                                <span class="tf-icons bx bx-edit-alt me-1"></span>ویرایش
                            </button>
                            <button type="button" class="btn btn-label-danger btn-sm">
                                <span class="tf-icons bx bx bx-trash me-1"></span>حذف
                            </button>
                        </td>
                    </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
