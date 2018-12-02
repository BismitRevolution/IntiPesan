<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EventController;
use App\Http\Controllers\NotificationController;
use App\Event;
use App\Registrant;
use App\RegistrantData;
use Endroid\QrCode\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegistrantController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $registrants = DB::table('registrant_datas')
        // ->where('registrants.registrant_id', '=', 'registrant')
        ->get();
        foreach($registrants as $registrant){
            $registrant->event = Event::find($registrant->event_id);
            // $registrant->event = DB::table('events')
            //                     ->where('events.event_id', '=', $registrant->event_id)
            //                     ->get();
        }
        return view('admin.registrant_data.index')->with(['registrants'=> $registrants]);
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
        return view('admin.registrant_data.create')->with('events', $events);
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
            'email' => 'required|email|max:255',
            'phone' => 'required',
            'company' => 'required',
            'payment_method' => 'required',
        ]);

        $event = Event::find($request->event_id);
        $username = sprintf("%s%'04d", $event->event_code, $event->registered + 1);
        $password = str_random(8);
        // dd($password);

        if (Registrant::where('email', '=', $username)->exists()) {

        } else {
            Registrant::create([
                'name' => $request->name,
                'email' => $username,
                'password' => bcrypt($password),
            ]);
        }
        app(EventController::class)->register($request->event_id);

        $registrant = new RegistrantData;
        $registrant->registration_code = $username;
        $registrant->name = $request->name;
        $registrant->email = $request->email;
        $registrant->position = $request->position;
        $registrant->phone = $request->phone;
        $registrant->company = $request->company;
        $registrant->company_address = $request->company_address;
        $registrant->payment_method = $request->payment_method;
        // $registrant->status = $request->status;
        // $registrant->certificate = $request->certificate;
        $qrcode = new QrCode($username);
        $qrcode->setSize(300);
        $hash_name = str_random(24);
        $path = sprintf('%s/%s%s', public_path('img/qrcodes'), $hash_name, '.png');
        $web_path = sprintf('%s/%s/%s%s', env('APP_URL', 'localhost:8000'), 'img/qrcodes', $hash_name, '.png');
        $qrcode->writeFile($path);
        $registrant->qr_path = $web_path;

        $registrant->event_id = $request->event_id;
        $registrant->created_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $registrant->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $registrant->save();

        app(NotificationController::class)->confirmation($registrant->registrant_id, $path, $username, $password);

        return redirect()->route('admin.registrants.index');
        // return redirect()->route('admin.registrants.show', $registrant->registrant_id);

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $registrant = DB::table('registrant_datas')
        ->where('registrants.registrant_id', '=', $id)
        ->first();

        return view('admin.registrant_data.show')
        ->with(['registrant' => $registrant]);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $registrant = DB::table('registrant_datas')
        ->where('registrant_datas.registrant_id', '=', $id)
        ->first();
        $events = DB::table('events')
        ->get();
        return view('admin.registrant_data.edit')
        ->with(['registrant' => $registrant, 'events' => $events]);
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
            'name' => 'required',
            // 'email' => 'required|email|max:255',
            'phone' => 'required',
            'company' => 'required',
            'payment_method' => 'required',
        ]);

        $registrant = RegistrantData::find($id);
        $registrant->name = $request->name;
        // $registrant->email = $request->email;
        $registrant->position = $request->position;
        $registrant->phone = $request->phone;
        $registrant->company = $request->company;
        $registrant->company_address = $request->company_address;
        $registrant->payment_method = $request->payment_method;
        // $registrant->status = $request->status;
        // $registrant->certificate = $request->certificate;
        $registrant->event_id = $request->event_id;
        $registrant->updated_at = Carbon::now('Asia/Jakarta')->format('Y-m-d H:i:s');
        $registrant->save();

        return redirect()->route('admin.registrants.index');
        // return redirect()->route('admin.registrants.show', $registrant->registrant_id);
    }

    public function status($request, $id) {
        $registrant = RegistrantData::find($id);
        $registrant->status = $request->status;
        $registrant->save();
    }

    public function certificate($request, $id) {
        $registrant = RegistrantData::find($id);
        $registrant->certificate = 1;
        $registrant->save();
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        // $registrant = DB::table('registrant_datas')->where('registrant_id', $id);
        $registrant = RegistrantData::find($id);
        app(EventController::class)->unregister($registrant->event_id);
        $registrant->delete();

        return redirect()->route('admin.registrants.index');
    }
}
