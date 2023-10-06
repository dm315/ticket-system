<!DOCTYPE html>

<html
    lang="fa_IR"
    class="dark-style customizer-hide"
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

    <title>{{ $title ?? 'سیستم تیکتینگ' }}</title>

    <meta name="description" content=""/>

    @include('livewire.support.dashboard.partials.styles')
    @yield('style')
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            {{ $slot }}
        </div>
    </div>
</div>

<!-- / Content -->
@include('livewire.support.dashboard.partials.scripts')
@yield('script')
</body>
</html>
