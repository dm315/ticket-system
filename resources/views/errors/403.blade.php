<html
    lang="fa"
    class="light-style customizer-hide"
    dir="rtl"
    data-theme="theme-default"
    data-assets-path="../../assets/"
    data-template="vertical-menu-template"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>مجاز نیستید | سیستم تیکتینگ</title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico"/>


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}"/>

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}"/>

    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>

    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
<!-- Content -->

<!-- Not Authorized -->
<div class="container-xxl container-p-y">
    <div class="misc-wrapper">
        <h2 class="mb-2 mx-2">شما دسترسی ندارید!</h2>
        <p class="mb-4 mx-2">
            شما اجازه ندارید این صفحه را با استفاده از اعتبارنامه‌هایی که هنگام ورود به سیستم ارائه کرده‌اید مشاهده
            کنید. <br/>
            لطفا با پشتیبان سایت خود تماس بگیرید
        </p>
        <a href="{{ route('dashboard.home') }}" class="btn btn-dark">بازگشت به خانه</a>
        <div class="mt-5">
            <img
                src="{{ asset('assets/img/illustrations/girl-with-laptop-light.png') }}"
                alt="page-misc-not-authorized-light"
                width="450"
                class="img-fluid"
                data-app-light-img="illustrations/girl-with-laptop-light.png"
                data-app-dark-img="illustrations/girl-with-laptop-dark.png"
            />
        </div>
    </div>
</div>
<!-- /Not Authorized -->

<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
</body>
</html>
