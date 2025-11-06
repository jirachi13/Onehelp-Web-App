<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::with(['organization', 'images'])->latest()->take(4)->get(); // Fetch 4 latest events with relationships
        return view('pages.home', compact('events'));
    }
}
