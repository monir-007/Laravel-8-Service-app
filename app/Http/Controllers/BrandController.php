<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            'name' => 'required|min:3|max:21|unique:brands',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);
        $brand_image = $request->file('image');

        $name_gen = hexdec(uniqid());
        $image_ext = strtolower($brand_image->getClientOriginalExtension());
        $image_name = $name_gen . '.' . $image_ext;
        $uploadLocation = 'image/brand/';
        $last_image = $uploadLocation . $image_name;
        $brand_image->move($uploadLocation, $image_name);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image = $last_image;
        $brand->save();
        return redirect()->back()->with('success', 'Brand created successfully!');
    }

    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('admin.brand.edit', compact('brands'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:21',
        ]);
        $old_image = $request->oldImage;
        $brand_image = $request->file('image');
        if ($brand_image) {
            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($brand_image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $uploadLocation = 'image/brand/';
            $last_image = $uploadLocation . $image_name;
            $brand_image->move($uploadLocation, $image_name);

            unlink($old_image);
            Brand::find($id)->update([
                'name' => $request->name,
                'image' => $last_image,
                'created_at' => Carbon::now()
            ]);

            return redirect()->back()->with('success', 'Brand updated successfully!');
        }
        Brand::find($id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success', 'Brand updated successfully!');
    }

    public function delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Brand::find($id)->delete();
        return redirect()->back()->with('success', 'Brand deleted successfully!');
    }
}
