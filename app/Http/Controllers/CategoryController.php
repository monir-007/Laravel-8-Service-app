<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Auth;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::latest()->paginate(4);
        $deleteCategories = Category::onlyTrashed()->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'deleteCategories'));
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
            'name' => $request->name,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('index.category')->with('success', 'Category updated successfully!');
    }

    public function softDelete($id)
    {
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Delete Successfully');
    }

    public function restoreCategory($id)
    {
        $delete = Category::withTrashed()->find($id)->restore();

        return redirect()->back()->with('success', 'Data restored');
    }

    public function deleteCategory($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();

        return redirect()->back()->with('success', 'Category deleted Permanently');
    }
}
