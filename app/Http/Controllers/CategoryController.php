<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
//        $categories = Category::latest()->paginate(5);

        $categories=DB::table('categories')
            ->join('users', 'categories.user_id','users.id')
            ->select('categories.*','users.name')
            ->latest()->paginate(5);

        return view('admin.category.index', compact('categories'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:21|unique:categories',
        ]);

        $category = new Category;
        $category->name = $request->name;
        $category->user_id = Auth::user()->id;
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully!');
    }
}
