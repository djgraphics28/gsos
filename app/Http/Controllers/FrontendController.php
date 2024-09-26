<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function faq()
    {
        $faqs = Faq::all();
        return view('frontend.faq', compact('faqs'));
    }

    public function services()
    {
        return view('frontend.services');
    }
}
