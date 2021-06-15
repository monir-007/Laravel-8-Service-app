<?php

namespace App\Http\Controllers;

use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ServicesController extends Controller
{
    public function index()
    {
        $services = Services::latest()->get();
        return view('admin.services.index', compact('services'));
    }
    public function saveNew(Request $request)
    {
        Services::insert([
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('index.services')->with('success', 'Services Inserted.');
    }
    public function edit($id)
    {
        $data = Services::find($id);
        return view('admin.services.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $update= Services::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'created_at' => Carbon::now(),
        ]);
        return redirect()->route('index.services')->with('success', 'Services Updated.');
    }

    public function delete($id)
    {
        Services::find($id)->Delete();
        return redirect()->back()->with('success', 'Services Deleted.');

    }
}
