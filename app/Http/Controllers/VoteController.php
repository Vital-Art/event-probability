<?php


namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function store(Request $request, Event $event)
    {
        $request->validate([
            'probability' => 'required|integer|min:0|max:100',
        ]);

        $vote = new Vote();
        $vote->event_id = $event->id;
        $vote->user_id = Auth::id();
        $vote->probability = $request->probability;
        $vote->save();

        return redirect()->route('home')->with('success', 'Vote recorded successfully.');
    }
}
