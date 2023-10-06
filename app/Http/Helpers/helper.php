<?php

use Carbon\Carbon;
use Morilog\Jalali\Jalalian;

function jalaliDate($date, $format = "%d %B %Y")
{
    return Jalalian::forge($date)->format($format); // جمعه، 23 اسفند 97
}


function avatar($name = null, $family = null)
{
    $stateNum = rand(0, 6);
    $states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
    $state = $states[$stateNum];
    if (!empty($name) && !empty($family)) {
        $initials = strtoupper((mb_substr($name, 0, 1)) . '‌' . (mb_substr($family, 0, 1)));
    } else {
        $initials = strtoupper((mb_substr($name, 0, 1)) . '‌' . (mb_substr($name, -1)));
    }
    $output = '<span class="avatar-initial rounded-circle fw-bold bg-label-' . $state . '">' . $initials . '</span>';
    return $output;
}


function randomBadge()
{
    $stateNum = rand(0, 6);
    $states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
    $state = $states[$stateNum];
    $badge = "badge bg-label-$state";
    return $badge;
}

function dayCount($startDate = null, $endDate)
{
    $startDate = Carbon::parse($startDate) ?? Carbon::now();
    $endDate = Carbon::parse($endDate);


    $diffinDays = $startDate->diffInDays($endDate);

    return $diffinDays;
}

function priceFormat($price)
{
    $price = number_format($price, 0, "/", ',');
    return $price;
}

function is_image($file)
{
    $allowedMimeTypes = ['image/jpeg', 'image/gif', 'image/png', 'image/jpg', 'image/bmp', 'image/svg+xml'];
    $contentType = mime_content_type($file);

    if (in_array($contentType, $allowedMimeTypes)) {
        return true;
    }
    return false;
}
