<!DOCTYPE html>

<html
    lang="fa_IR"
    class="dark-style layout-navbar-fixed layout-menu-fixed"
    dir="rtl"
    data-theme="theme-default"
    data-assets-path="../../../assets/"
    data-template="vertical-menu-template-starter"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $title ?? 'داشبورد تیکتینگ' }}</title>

    <meta name="description" content=""/>
    @include('livewire.support.dashboard.partials.styles')
    @yield('style')
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->
        <livewire:support.dashboard.sidebar/>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <livewire:support.dashboard.header/>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    {{ $slot }}
                </div>
                <!-- / Content -->


                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

@include('livewire.support.dashboard.partials.scripts')
@yield('script')

<!-- Page JS -->
</body>
</html>
