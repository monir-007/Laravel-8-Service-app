<?php

namespace App\Http\Controllers;

use App\Models\MultiImage;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $images = MultiImage::all();
        return view('pages.portfolio.index', compact('images'));
    }
}
