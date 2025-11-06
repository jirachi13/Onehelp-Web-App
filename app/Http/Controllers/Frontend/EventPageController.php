<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Event;

class EventPageController extends Controller
{
    // Show all events (for /events)
    public function index()
    {
        $events = Event::with(['organization', 'images'])->latest()->get();
        return view('pages.events', compact('events'));
    }

    // Show one event (for /events/{id})
    public function show($id)
    {
        $event = Event::with(['organization', 'images'])->findOrFail($id);
        return view('pages.event-detail', compact('event'));
    }

    // Static event detail pages
    public function greenSteps()
    {
        return view('pages.event-details-1');
    }

    public function readRise()
    {
        return view('pages.event-details-2');
    }

    public function kusinaKabuhayan()
    {
        return view('pages.event-details-3');
    }

    public function careCompanions()
    {
        return view('pages.event-details-4');
    }

    public function tindahanPagAsa()
    {
        return view('pages.event-details-5');
    }
}
