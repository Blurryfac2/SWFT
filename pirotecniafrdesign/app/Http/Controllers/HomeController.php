<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CarouselImage;

class HomeController extends Controller
{
    public function home()
    {
        $carouselImages = CarouselImage::latest()->get();
        return view('welcome', compact('carouselImages'));
    }
}
