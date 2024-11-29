<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\MultiImage;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $images = MultiImage::all();
        $contactDetails = Contact::latest()->first();
        return view('pages.portfolio.index', compact('images','contactDetails'));
    }
}
