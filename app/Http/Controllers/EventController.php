<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Inertia\Inertia;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('start_at', '>=', now())
                    ->with(['user', 'tags'])
                    ->paginate(5);
        return response()->json([
            'events' => $events,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = $auth_user = auth()->user();

        $auth_user->events()->create([
            'title' => $request->title,
            'start_at' => $request->start_at,
            'end_at' => $request->end_at,
        ]);


        $tags = explode(',', $request->tags);

        foreach ($tags as $input){
            $input = trim($input);

            $tag = Tag::firstOrCreate([
                'name' => $input,
            ], [
                'name' => $input,
            ]);

            $event->tags()->attach($tag->id);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request, Event $event)
    {
        $event = Event::find($id);
        $event->update($request->all());
        return response()->json([
            'success' => true,
            $event
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return response()->json('Event deleted!');
    }

    public function search(Request $request)
    {
        $start_at = $request->input('start_at');
        $end_at = $request->input('end_at');

        $query = DB::table('events')->select()
                ->where('start_at', '>=', $start_at)
                ->where('end_at', '<=', $end_at)
                ->get();
        return response()->json($query);
    }
}
