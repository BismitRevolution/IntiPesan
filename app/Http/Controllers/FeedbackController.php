<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Track;
use App\ResponseTrack;
use App\ResponseSpeaker;
use Carbon\Carbon;

class FeedbackController extends Controller
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
            $track->reviewed = DB::table('responsetracks')
                                ->where('registrant_email', $logged->email)
                                ->where('track_id', $track->track_id)
                                ->count();
        }
        // dd($tracks);
        return view('registrant.feedbacks.index')->with('tracks', $tracks);
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

    public function view($id) {
        // ADMIN DASHBOARD
        $tracks = DB::table('tracks')
                    ->where('tracks.archived', false)
                    ->where('event_id', '=', $id)
                    ->orderBy('number', 'asc')
                    ->get();

        $q_sessions = DB::table('questions')
                        ->where('archived', false)
                        ->where('type', 1)
                        ->orderBy('order', 'asc')
                        ->get();

        $q_speakers = DB::table('questions')
                        ->where('archived', false)
                        ->where('type', 0)
                        ->orderBy('order', 'asc')
                        ->get();

        foreach($tracks as $track){
            $track->feedbacks = DB::table('responsetracks')
                                ->where('track_id', $track->track_id)
                                ->get();

            $track->speakers = DB::table('speakers')
                                ->where('speakers.archived', '=', false)
                                ->where('speakers.track_id', '=', $track->track_id)
                                ->get();

            foreach ($track->speakers as $speaker) {
                $speaker->feedbacks = DB::table('responsespeakers')
                                        ->where('speaker_id', $speaker->speaker_id)
                                        ->get();
            }
        }

        return view('admin.feedbacks.index')->with([
            'event_id' => $id,
            'tracks' => $tracks,
            'q_sessions' => $q_sessions,
            'q_speakers' => $q_speakers,
        ]);
    }

    public function track($id) {
        // FOR REGISTRANT FORM
        $track = Track::find($id);

        $q_sessions = DB::table('questions')
                        ->where('archived', false)
                        ->where('type', 1)
                        ->orderBy('order', 'asc')
                        ->get();

        $q_speakers = DB::table('questions')
                        ->where('archived', false)
                        ->where('type', 0)
                        ->orderBy('order', 'asc')
                        ->get();

        $speakers = DB::table('speakers')
                        ->where('track_id', $id)
                        ->where('archived', false)
                        ->get();

        foreach($speakers as $speaker){
            $speaker->questions = $q_speakers;
        }

        return view('registrant.feedbacks.viewform')->with([
            'track' => $track,
            'q_sessions' => $q_sessions,
            'speakers' => $speakers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // FOR REGISTRANT SUBMIT FORM
        $logged = Auth::guard('registrant')->user();

        $response = new ResponseTrack;
        foreach ($request->session as $key => $value) {
            $response->$key = $value;
        }
        $response->registrant_email = $logged->email;
        $response->track_id = $request->track_id;
        $response->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $response->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $response->save();

        $total = DB::table('speakers')
                    ->where('track_id', $request->track_id)
                    ->where('archived', false)
                    ->count();

        for ($i = 0; $i < $total; $i++) {
            $speaker = new ResponseSpeaker;
            foreach ($request->speaker as $key => $value) {
                $speaker->$key = $value[$i];
            }
            $speaker->registrant_email = $logged->email;
            $speaker->speaker_id = $request->speaker["speaker_id"][$i];
            $speaker->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $speaker->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
            $speaker->save();
        }

        return redirect()->route('registrant.feedbacks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $tracks = DB::table('tracks')
        //             ->where('event_id', $id)
        //             ->get();
        // return view('registrant.feedbacks.index')->with('tracks', $tracks);
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
