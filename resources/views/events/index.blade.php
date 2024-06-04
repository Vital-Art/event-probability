@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">Events</h1>

        @foreach ($events as $event)
            <div class="bg-white shadow-md rounded-lg p-4 mb-4">
                <h2 class="text-xl font-semibold">{{ $event->title }}</h2>
                <p>{{ $event->description }}</p>
                <p>Date: {{ $event->event_date }}</p>
                <p>Probability: {{ $event->averageProbability() }}%</p>
                
                @auth
                    <form action="{{ route('events.vote', $event) }}" method="POST">
                        @csrf
                        <label for="probability">Vote:</label>
                        <select name="probability" id="probability">
                            <option value="0">0%</option>
                            <option value="25">25%</option>
                            <option value="50">50%</option>
                            <option value="75">75%</option>
                            <option value="100">100%</option>
                        </select>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                    </form>
                @endauth
            </div>
        @endforeach
    </div>
@endsection
