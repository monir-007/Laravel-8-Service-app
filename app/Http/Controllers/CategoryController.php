<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

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

        $data = [];
        $data['name'] = $request->name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);

        return redirect()->back()->with('success', 'Category created successfully!');
    }
}
