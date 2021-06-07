<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
return view('admin.category.index');
    }

    public function save(Request  $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|min:3|max:21|unique:categories',
        ]);
    }
}
