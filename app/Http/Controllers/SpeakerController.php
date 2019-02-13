<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Speaker;
use Carbon\Carbon;

class SpeakerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Not used by use case
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Combined with track index instead
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'company' => 'required',
            'track_id' => 'required',
        ]);

        $speaker = new Speaker;
        $speaker->track_id = $request->track_id;
        $speaker->name = $request->name;
        $speaker->position = $request->position;
        $speaker->company = $request->company;
        $speaker->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $speaker->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $speaker->save();

        return redirect()->route('admin.tracks.show', $request->event_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Not used by the use case
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $speaker = Speaker::find($id);
        return view('admin.speakers.edit')->with('speaker', $speaker);
    }

    public function change($id, $event_id) {
        $speaker = Speaker::find($id);
        return view('admin.speakers.edit')->with([
            'speaker' => $speaker,
            'event_id' => $event_id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Use save method instead
    }

    public function save(Request $request, $id, $event_id) {
        $request->validate([
            'name' => 'required',
            'position' => 'required',
            'company' => 'required',
        ]);

        $speaker = Speaker::find($id);
        $speaker->name = $request->name;
        $speaker->position = $request->position;
        $speaker->company = $request->company;
        $speaker->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $speaker->save();

        return redirect()->route('admin.tracks.show', $request->event_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Use method archive instead
    }

    public function archive($id, $event_id) {
        $speaker = Speaker::find($id);
        $speaker->archived = true;
        $speaker->save();

        return redirect()->route('admin.tracks.show', $event_id);
    }
}
