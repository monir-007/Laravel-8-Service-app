<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->paginate(2);
        return view('admin.slider.index', compact('sliders'));
    }

    public function saveNew(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/' . $name_gen);
        $last_image = 'image/slider/' . $name_gen;

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image = $last_image;
        $slider->save();

        $notification = array(
            'message' => 'Slider created successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('index.slider')->with($notification);

    }

    public function edit($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $old_image = $request->oldImage;
        $slider_image = $request->file('image');
        if ($slider_image) {
            $name_gen = hexdec(uniqid());
            $image_ext = strtolower($slider_image->getClientOriginalExtension());
            $image_name = $name_gen . '.' . $image_ext;
            $uploadLocation = 'image/slider/';
            $last_image = $uploadLocation . $image_name;
            $slider_image->move($uploadLocation, $image_name);

            unlink($old_image);

            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_image,
                'created_at' => Carbon::now()
            ]);
            $notification = array(
                'message' => 'Slider updated successfully!',
                'alert-type' => 'info'
            );
            return redirect()->route('index.slider')->with($notification);

        }
        Slider::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'updated_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Slider updated successfully!',
            'alert-type' => 'success'
        );
        return redirect()->route('index.slider')->with($notification);
    }

    public function delete($id)
    {
        $data = Slider::find($id);
        $oldImage = $data->image;
        unlink($oldImage);

        Slider::find($id)->delete();
        $notification = array(
            'message' => 'Slider updated successfully!',
            'alert-type' => 'error'
        );
        return redirect()->back()->with($notification);
    }
}
