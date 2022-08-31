<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BuildingController extends Controller
{
    public function index()
    {
        return view('admin.buildings.index');
    }

    public function show($building)
    {
        return view('admin.buildings.show', compact('building'));
    }
}
