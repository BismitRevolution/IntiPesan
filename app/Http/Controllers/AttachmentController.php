<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // FOR REGISTRANT DASHBOARD
        $logged = Auth::guard('registrant')->user();
        $tracks = DB::table('registrants')
                    ->where('registrants.email', $logged->email)
                    ->join('registrant_datas', 'registrants.email', '=', 'registrant_datas.registration_code')
                    ->join('events', 'events.event_id', '=', 'registrant_datas.event_id')
                    ->join('tracks', 'tracks.event_id', '=', 'events.event_id')
                    ->orderBy('tracks.number', 'asc')
                    ->get();
        foreach($tracks as $track){
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
        // dd($tracks);
        return view('registrant.attachments.index')->with('tracks', $tracks);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
