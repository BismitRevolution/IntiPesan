<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Verification;
use App\Mail\RegistrationEmail;
use Endroid\QrCode\QrCode;
use Carbon\Carbon;

class PageController extends Controller
{
    //
    public function index() {
        return view('index');
    }

    public function home() {
        return view('registrant.pages.hrexpo');
    }

    public function verify(Request $request, $id) {
        $registrant = DB::table('registrant_datas')
                            ->where('registrant_datas.registration_token', '=', $id)
                            ->first();

        if ($registrant == null) {
            return response()->json([
                'status' => 404,
                'message' => 'Registrant not found',
                'payload' => sprintf('Verify failed for id %s', $id),
            ]);
        }

        $verification = DB::table('verifications')
                            ->where('verifications.registration_code', '=', $id)
                            ->where('verifications.date', '=', Carbon::now('Asia/Jakarta')->format('Y-m-d'))
                            ->first();

        if ($verification != null) {
            return response()->json([
                'status' => 201,
                'message' => 'OK',
                'payload' => $registrant,
            ]);
        }

        $registrant = DB::table('registrant_datas')
                            ->where('registrant_datas.registration_token', '=', $id)
                            ->update(['registrant_datas.status' => 1]);

        $verification = new Verification;
        $verification->registration_code = $id;
        $verification->date = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        $verification->time = Carbon::now('Asia/Jakarta')->format('H:i:s');
        $verification->save();

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'payload' => $registrant,
        ]);
    }

    public function notify() {
        app(NotificationController::class)->notify();

        return response()->json([
            'status' => 200,
            'message' => 'OK',
            'payload' => null,
        ]);
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
                            ->where('notifications.type', '=', 1)
                            ->join('events', 'events.event_id', '=', 'registrant_datas.event_id')
                            ->first();
        return view('mail.registration-inline')->with([
        // return view('mail.notification')->with([
            'data' => $data,
            'path' => 'http://localhost:8000/img/qrcodes/o81XaFCJKrPb52ePRIgkahL6.png',
            'username' => $data->registration_code,
            'password' => 'KHG8syZu',
            // 'username' => 'admin@bismitrevolution.com',
            // 'password' => 'admin'
        ]);
        // $data = DB::table('registrant_datas')
        //                     ->where('registrant_datas.registrant_id', '=', $id)
        //                     ->join('notifications', 'notifications.event_id', '=', 'registrant_datas.event_id')
        //                     ->where('notifications.type', '=', -1)
        //                     ->join('events', 'events.event_id', '=', 'registrant_datas.event_id')
        //                     ->first();
        // if ($data != null) {
        //     app(MailController::class)->register($data, $path, $username, $password);
        //     $this->log($data);
        // }
    }
}
