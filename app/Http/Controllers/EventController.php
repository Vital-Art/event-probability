<?php


namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('votes')->get();
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $event = new Event();
        $event->user_id = Auth::id();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->event_date = $request->event_date;

        if ($request->hasFile('image')) {
            $event->image = $request->file('image')->store('events');
        }

        $event->save();

        return redirect()->route('home')->with('success', 'Event created successfully.');
    }



    // Методы show, edit и update можно не реализовывать, если редактирование не требуется.
}
