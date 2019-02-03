<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Media;
use Carbon\Carbon;
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
        $upcoming = DB::table('events')
                    // ->where('events.category', '=', 'event')
                    ->where('events.end_date', '>=', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                    ->orderBy('events.start_date', 'asc')
                    ->get();
        foreach($upcoming as $event){
            $event->media = DB::table('media')
                                ->where('media.event_id', '=', $event->event_id)
                                ->get();
        }

        $history = DB::table('events')
                    // ->where('events.category', '=', 'event')
                    ->where('events.end_date', '<', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                    ->orderBy('events.end_date', 'desc')
                    ->get();
        foreach($history as $event){
            $event->media = DB::table('media')
                                ->where('media.event_id', '=', $event->event_id)
                                ->get();
        }

        return view('admin.events.index')->with(['upcoming_events' => $upcoming, 'history_events' => $history]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
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
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required',
            'quota' => 'required',
            'location' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
        ]);

       $event = new Event;
       $event->event_code = substr(str_replace(' ', '', strtoupper($request->title)), 0, 3) . Carbon::now('Asia/Jakarta')->format('mY');
       $event->title = $request->title;
       $event->category = $request->category;
       $event->description = $request->description;
       $event->quota = $request->quota;
       $event->location = $request->location;
       $event->start_date = $request->start_date;
       $event->start_time = $request->start_time;
       $event->end_date = $request->end_date;
       $event->end_time = $request->end_time;
       $event->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
       $event->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
       $event->save();

       $files = $request->file('img_path');
       // dd($files);
       if($request->hasFile('img_path')) {
            foreach ($files as $file) {
                $path = $file->store(
                    '/public/'.$event->event_id
                );
                $media = new Media;
                $media->path = substr($path, 7);
                $media->event_id = $event->event_id;
                $media->save();
                // dd($phpath);
            }
        }

        return redirect()->route('admin.events.index');
        // return redirect()->route('admin.events.show', $event->event_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = DB::table('events')
                    ->where('events.event_id', '=', $id)
                    ->first();

        $unverifieds = DB::table('registrant_datas')
                            ->where('registrant_datas.event_id', '=', $id)
                            ->where('registrant_datas.status', '=', 0)
                            // ->orderBy('status', 'desc')
                            ->get();

        $verifieds = DB::table('verifications')
                            ->join('registrant_datas', 'registrant_datas.registration_code', '=', 'verifications.registration_code')
                            ->where('registrant_datas.event_id', '=', $id)
                            ->where('verifications.date', '=', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                            ->get();

        // $media = DB::table('media')
        //             ->where('media.event_id', '=', $event->event_id)
        //             ->get();

        return view('admin.events.show')
                    ->with(['event' => $event, 'unverifieds' => $unverifieds, 'verifieds' => $verifieds]);
    }

    public function resetVerification($id) {
        $event = Event::find($id);

        if ($event == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Event not found',
                'payload' => sprintf('Reset verification failed for event id %s', $id),
            ]);
        }

        $registrants = DB::table('registrant_datas')
                            ->where('registrant_datas.event_id', '=', $id)
                            ->update(['registrant_datas.status' => 0]);

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'payload' => sprintf('Reset verification success for event id %s', $id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = DB::table('events')
                    ->where('events.event_id', '=', $id)
                    ->first();

        $media = DB::table('media')
                    ->where('media.event_id', '=', $event->event_id)
                    ->get();

        return view('admin.events.edit')
                    ->with(['event' => $event, 'media' => $media]);
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
            'title' => 'required|max:255',
            'category' => 'required',
            'description' => 'required',
            'quota' => 'required',
            // 'start_date' => 'required',
            // 'start_time' => 'required',
            // 'end_date' => 'required',
            // 'end_time' => 'required',
        ]);

        $event = Event::find($id);

        $event->title = $request->title;
        $event->category = $request->category;
        $event->description = $request->description;
        $event->quota = $request->quota;
        // $event->start_date = $request->start_date;
        // $event->start_time = $request->start_time;
        // $event->end_date = $request->end_date;
        // $event->end_time = $request->end_time;
        $event->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $event->save();

        return redirect()->route('admin.events.index');
        // return redirect()->route('admin.events.show', $event->event_id);
    }

    public function register($id) {
        $event = Event::find($id);
        $event->registered = $event->registered + 1;
        $event->counter = $event->counter + 1;
        $event->save();
    }

    public function unregister($id) {
        $event = Event::find($id);
        $event->registered = $event->registered - 1;
        $event->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = DB::table('events')->where('event_id', $id);
        $medias = DB::table('media')->where('event_id', $id);
        $notifications = DB::table('notifications')->where('event_id', $id);
        $logs = DB::table('logs')->where('event_id', $id);
        $registrants = DB::table('registrant_datas')->where('event_id', $id);

        $notifications->delete();
        $registrants->delete();
        $logs->delete();
        $medias->delete();
        $event->delete();

        return redirect()->route('admin.events.index');
    }
}
