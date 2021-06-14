<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUss = AboutUs::latest()->get();
        return view('admin.about-us.index', compact('aboutUss'));
    }

    public function saveNew(Request $request)
    {
        AboutUs::insert([
            'title' => $request->title,
            'shortText' => $request->shortText,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('index.aboutUs')->with('success', 'About Us Inserted.');
    }

    public function edit($id)
    {
        $data = AboutUs::find($id);
        return view('admin.about-us.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
       $update= AboutUs::find($id)->update([
            'title' => $request->title,
            'shortText' => $request->shortText,
            'description' => $request->description,
            'created_at' => Carbon::now(),

        ]);
        return redirect()->route('index.aboutUs')->with('success', 'About Us Updated.');
    }

    public function delete($id)
    {
        AboutUs::find($id)->Delete();
        return redirect()->back()->with('success', 'About Us Deleted.');

    }
}
