<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function account()
    {
        return view('admin.settings.edit-account');
    }

    public function application()
    {
        return view('admin.settings.application-settings');
    }
}