<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationEmail;
use Endroid\QrCode\QrCode;
use Carbon\Carbon;

class PageController extends Controller
{
    //
    public function index() {
        return view('index');
    }

    public function test() {
        // $data = DB::table('notifications')
        //                     ->where('notifications.publication_date', '=', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
        //                     ->join('events', 'events.event_id', '=', 'notifications.event_id')
        //                     ->join('registrant_datas', 'registrant_datas.event_id', '=', 'events.event_id')
        //                     ->first();
        // Mail::to($data->email)->send(new RegistrationEmail($data));
        // dd($data);

        // $registration_code = 'EVE0001';
        // $qrcode = new QrCode($registration_code);
        // $qrcode->setSize(300);
        // $path = sprintf('%s/%s%s', public_path('img/qrcodes'), str_random(24), '.png');
        // $qrcode->writeFile($path);
        $data = DB::table('registrant_datas')
                            ->where('registrant_datas.registrant_id', '=', 1)
                            ->join('notifications', 'notifications.event_id', '=', 'registrant_datas.event_id')
                            ->where('notifications.type', '=', -1)
                            ->join('events', 'events.event_id', '=', 'registrant_datas.event_id')
                            ->first();
        return view('mail.registration')->with([
        // return view('mail.notification')->with([
            'data' => $data,
            'path' => 'http://192.168.1.15:8000/img/qrcodes/LVZ3mDXrHG9bQQDfLp1oklYt.png',
            'username' => 'username',
            'password' => 'yourpassword',
        ]);
    }
}
