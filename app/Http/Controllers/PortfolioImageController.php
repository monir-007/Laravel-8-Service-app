<?php

namespace App\Http\Controllers;

use App\Models\MultiImage;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PortfolioImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $images = MultiImage::all();
        return view('admin.portfolio-image.index', compact('images'));
    }

    public function save(Request $request)
    {
        $image = $request->file('image');
        foreach ($image as $multipleImage)
        {
        $imageName = hexdec(uniqid()).'.'.$multipleImage->getClientOriginalExtension();
        Image::make($multipleImage)->resize(300, 300)->save('image/multiple/'.$imageName);
        $lastImage = 'image/multiple/'.$imageName;

        $multiImage = new MultiImage();
        $multiImage->image=$lastImage;
        $multiImage->save();
        }

        $notification = array(
            'message' => 'Portfolio Image Uploaded',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
