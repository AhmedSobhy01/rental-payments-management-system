<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DueCategoryController extends Controller
{
    public function index()
    {
        return view('admin.due-categories.index');
    }

    public function show($due_category)
    {
        return view('admin.due-categories.show', compact('due_category'));
    }
}