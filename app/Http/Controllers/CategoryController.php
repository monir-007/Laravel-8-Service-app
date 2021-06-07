<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
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

    public function edit($id)
    {
        $categories = Category::find($id);
        return view('admin.category.edit', compact('categories'));
    }

    public function update(Request $request, $id)
    {
        $data = Category::find($id)->update([
            'name'=>$request->name,
            'user_id'=>Auth::user()->id
        ]);

        return redirect()->route('index.category')->with('success', 'Category updated successfully!');
    }
}
