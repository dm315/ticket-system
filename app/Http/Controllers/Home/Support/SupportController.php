<?php

namespace App\Http\Controllers\Home\Support;

use App\Http\Controllers\Controller;
use App\Models\User;

class SupportController extends Controller
{
    public function getAllUser()
    {
        $data = User::all();

        return $data;
    }
}
