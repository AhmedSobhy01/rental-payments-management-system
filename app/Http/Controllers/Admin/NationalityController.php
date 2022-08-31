<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NationalityController extends Controller
{
    public function index()
    {
        return view('admin.nationalities.index');
    }
}