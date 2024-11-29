<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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

        $name_gen = hexdec(uniqid()).'.'.$brand_image->getClientOriginalExtension();
        Image::make($brand_image)->resize(300, 200)->save('image/brand/'.$name_gen);
        $last_image = 'image/brand/'.$name_gen;

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->image = $last_image;
        $brand->save();

        $notification=array(
            'message'=>'Brand created successfully!',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
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
            $notification=array(
                'message'=>'Brand updated successfully!',
                'alert-type'=> 'info'
            );

            return redirect()->back()->with($notification);
        }
        Brand::find($id)->update([
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ]);

        $notification=array(
            'message'=>'Brand created successfully!',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function delete($id)
    {
        $image = Brand::find($id);
        $old_image = $image->image;
        unlink($old_image);

        Brand::find($id)->delete();

        $notification=array(
            'message'=>'Brand deleted successfully!',
            'alert-type'=> 'error'
        );
        return redirect()->back()->with($notification);
    }

}
