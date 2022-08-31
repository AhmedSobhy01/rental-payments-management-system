<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DueController extends Controller
{
    public function show($due)
    {
        return view('admin.dues.show', compact('due'));
    }
}