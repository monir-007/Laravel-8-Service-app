<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:21|unique:categories',
        ]);

        Category::insert([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'created_at' => Carbon::now()
        ]);
    }
}
