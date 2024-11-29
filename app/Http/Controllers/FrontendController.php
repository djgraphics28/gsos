<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Service;
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
         // Fetch services from the database
         $services = Service::all(); // You can paginate or add conditions as needed

         // Pass the services to the view
         return view('frontend.services', compact('services'));
    }

    public function submitRequest()
    {
        return view('frontend.submit-request');
    }

    public function requestSuccess()
    {
        return view('frontend.success-request-page');
    }
}
