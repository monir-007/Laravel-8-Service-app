<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use function Livewire\str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::latest()->paginate(3);
        return view('admin.brand.index', compact('brands'));
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
            'name'=> 'required|min:3|max:21|unique:brands',
            'image'=>'required|mimes:jpg,jpeg,png',
        ]);
        $brand_image=$request->file('image');

        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen.'.'.$image_ext;
        $uploadLocation = 'image/brand/';
        $last_image = $uploadLocation.$image_name;
        $brand_image->move($uploadLocation, $image_name);

        $brand= new Brand();
        $brand->name=$request->name;
        $brand->image=$last_image;
        $brand->save();
        return redirect()->back()->with('success', 'Brand created successfully!');

    }
}
