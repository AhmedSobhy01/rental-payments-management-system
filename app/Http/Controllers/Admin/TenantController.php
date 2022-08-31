<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TenantController extends Controller
{
    public function index()
    {
        return view('admin.tenants.index');
    }

    public function show($tenant)
    {
        return view('admin.tenants.show', compact('tenant'));
    }
}