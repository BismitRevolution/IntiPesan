<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationEmail;
use Carbon\Carbon;

class PageController extends Controller
{
    //
    public function index() {
        return view('index');
    }

    public function test() {
        $data = DB::table('notifications')
                            ->where('notifications.publication_date', '=', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                            ->join('events', 'events.event_id', '=', 'notifications.event_id')
                            ->join('registrant_datas', 'registrant_datas.event_id', '=', 'events.event_id')
                            ->first();
        Mail::to($data->email)->send(new RegistrationEmail($data));
        dd($data);
    }
}
