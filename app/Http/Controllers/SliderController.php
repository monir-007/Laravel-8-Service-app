<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function saveNew(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description'=>'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $slider_image = $request->file('image');

        $name_gen = hexdec(uniqid()).'.'.$slider_image->getClientOriginalExtension();
        Image::make($slider_image)->resize(1920, 1088)->save('image/slider/'.$name_gen);
        $last_image = 'image/slider/'.$name_gen;

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->description = $request->description;
        $slider->image=$last_image;
        $slider->save();
        return redirect()->route('index.slider')->with('success', 'Slider created successfully!');

    }
    public function edit($id)
    {
        $sliders = Slider::find($id);
        return view('admin.slider.edit', compact('sliders'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title' => 'required',
            'description'=>'required',
            'image' => 'required|mimes:jpg,jpeg,png',
        ]);

        $oldImage = $request->oldImage;
        $sliderImage = $request->file('image');
        if($sliderImage)
        {
            $nameGenerator = hexdec(uniqid()).'.'.$sliderImage->getClientOriginalExtension();
            Image::make($sliderImage)->resize(1920, 1088)->save('image/slider/'.$nameGenerator);
            $lastImage = 'image/slider/'.$nameGenerator;

            unlink($oldImage);
            Slider::find($id)->update([
                'title'=>$request->title,
                'description'=>$request->description,
                'image'=>$lastImage,
                'created_at'=>Carbon::now()
            ]);
            return redirect()->route('index.slider')->with('success', 'Slider updated successfully!');

        }
        Slider::find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description
        ]);
        return redirect()->route('index.slider')->with('success', 'Slider updated successfully!');
    }
}
