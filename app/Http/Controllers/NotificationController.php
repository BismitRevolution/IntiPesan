<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Event;
use App\Notification;
use App\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = DB::table('notifications')
                    // ->where('notifications.category', '=', 'event')
                    ->get();
        foreach($notifications as $notification){
            $notification->event = Event::find($notification->event_id);
            // $registrant->event = DB::table('notifications')
            //                     ->where('notifications.event_id', '=', $registrant->event_id)
            //                     ->get();
        }
        // dd($notifications);
        return view('admin.notifications.index')->with(['notifications'=> $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $events = DB::table('events')
                ->get();
        return view('admin.notifications.create')->with('events', $events);
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
            'type' => 'required',
            'content' => 'required',
            // 'location' => 'required',
            // 'publication_date' => 'required',
            // 'publication_time' => 'required',
        ]);

       $notification = new Notification;

       $notification->type = $request->type;

       $event = Event::find($request->event_id);
       $date = Carbon::createFromFormat('Y-m-d', $event->start_date);

       $notification->content = $request->content;
       // $notification->location = $request->location;
       $notification->event_id = $request->event_id;

       if ($request->type != -1) {
           $notification->publication_date = $date->subDays($request->type);
           $notification->publication_time = '09:00:00';
           // $notification->publication_date = $request->publication_date;
           // $notification->publication_time = $request->publication_time;
       } else {
           $notification->publication_date = null;
           $notification->publication_time = null;
       }
       $notification->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
       $notification->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
       $notification->save();

        return redirect()->route('admin.notifications.index');
        // return redirect()->route('admin.notifications.show', $notification->event_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = DB::table('notifications')
                    ->where('notifications.notification_id', '=', $id)
                    ->first();

        return view('admin.notifications.show')
                    ->with(['event' => $notification]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = DB::table('notifications')
                    ->where('notifications.notification_id', '=', $id)
                    ->first();
        $events = DB::table('events')
                ->get();
        return view('admin.notifications.edit')
                    ->with(['notification' => $notification, 'events' => $events]);
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
            'type' => 'required',
            'content' => 'required',
            // 'location' => 'required',
            // 'publication_date' => 'required',
            // 'publication_time' => 'required',
        ]);

        $notification = Notification::find($id);

        $notification->type = $request->type;

        $event = Event::find($request->event_id);
        $date = Carbon::createFromFormat('Y-m-d', $event->start_date);

        $notification->content = $request->content;
        // $notification->location = $request->location;
        $notification->event_id = $request->event_id;

        if ($request->type != -1) {
            $notification->publication_date = $date->subDays($request->type);
            $notification->publication_time = '09:00:00';
            // $notification->publication_date = $request->publication_date;
            // $notification->publication_time = $request->publication_time;
        }

        $notification->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $notification->save();

        return redirect()->route('admin.notifications.index');
        // return redirect()->route('admin.notifications.show', $notification->event_id);
    }

    public function notify() {
        $datas = DB::table('notifications')
                            ->where('notifications.publication_date', '=', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                            ->join('events', 'events.event_id', '=', 'notifications.event_id')
                            ->join('registrant_datas', 'registrant_datas.event_id', '=', 'events.event_id')
                            ->get();
        // $logs = DB::table('logs')->get();
        foreach ($datas as $data) {
            app(MailController::class)->notify($data);
            $this->log($data);
        }
    }

    public function confirmation($id, $username, $password) {
        $data = DB::table('registrant_datas')
                            ->where('registrant_datas.registrant_id', '=', $id)
                            ->join('notifications', 'notifications.event_id', '=', 'registrant_datas.event_id')
                            ->where('notifications.type', '=', -1)
                            ->join('events', 'events.event_id', '=', 'registrant_datas.event_id')
                            ->first();
        if ($data != null) {
            app(MailController::class)->register($data, $username, $password);
            $this->log($data);
        }
    }

    public function log($data) {
        $log = new Log;
        $log->email = $data->email;
        $log->event_id = $data->event_id;
        $log->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $log->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $log->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = DB::table('notifications')->where('notification_id', $id);
        $notification->delete();

        return redirect()->route('admin.notifications.index');
    }
}
