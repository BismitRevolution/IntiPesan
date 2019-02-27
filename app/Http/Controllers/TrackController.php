<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Track;
use App\Speaker;
use App\Attachment;
use Carbon\Carbon;

class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tracks = DB::table('tracks')
                    ->get();
        return view('admin.tracks.index')->with('tracks', $tracks);
    }

    public function add($id) {
        return view('admin.tracks.create')->with('event_id', $id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tracks.create');
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
            'number' => 'required',
            'topic' => 'required',
            'event_id' => 'required',
        ]);

        $track = new Track;
        $track->number = $request->number;
        $track->topic = $request->topic;
        $track->event_id = $request->event_id;
        $track->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $track->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $track->save();

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
        $tracks = DB::table('tracks')
                    ->where('tracks.archived', false)
                    ->where('event_id', '=', $id)
                    ->orderBy('number', 'asc')
                    ->get();
        foreach($tracks as $track) {
            $track->speakers = DB::table('speakers')
                                ->where('speakers.archived', '=', false)
                                ->where('speakers.track_id', '=', $track->track_id)
                                ->get();

            foreach($track->speakers as $speaker) {
                $speaker->attachments = DB::table('attachments')
                                            ->where('attachments.speaker_id', $speaker->speaker_id)
                                            ->where('attachments.archived', false)
                                            ->get();
            }
        }
        return view('admin.tracks.index')->with([
            'event_id' => $id,
            'tracks' => $tracks
        ]);
    }

    public function upload(Request $request) {
        // dd($request);
        $files = $request->file('attachment');
        // dd($files);
        if($request->hasFile('attachment')) {
            foreach ($files as $file) {
                $path = $file->store(
                    '/public/'.$request->speaker_id
                );
                $attachment = new Attachment;
                $attachment->path = substr($path, 7);
                $attachment->format = $request->format;
                $attachment->filename = $request->filename;
                $attachment->speaker_id = $request->speaker_id;
                $attachment->save();
                // dd($phpath);
            }
        }
        return redirect()->route('admin.tracks.show', $request->event_id);
    }

    public function removeAttachment($id, $event_id) {
        $attachment = Attachment::find($id);
        $attachment->archived = true;
        $attachment->save();

        return redirect()->route('admin.tracks.show', $event_id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $track = Track::find($id);
        $event_id = $track->event_id;
        return view('admin.tracks.edit')->with([
            'track' => $track,
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
        $request->validate([
            'number' => 'required',
            'topic' => 'required',
        ]);

        $track = Track::find($id);
        $track->number = $request->number;
        $track->topic = $request->topic;
        $track->save();

        return redirect()->route('admin.tracks.show', $track->event_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $track = Track::find($id);
        $track->archived = true;
        $track->save();

        return redirect()->route('admin.tracks.show', $track->event_id);
    }
}
