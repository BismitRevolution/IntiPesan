<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationEmail;
use App\Event;
use App\Notification;
use App\RegistrantData;

class MailController extends Controller
{
    public function registration($data) {
        // $notification = Notification::find($id);
        Mail::to($data->email)->send(new RegistrationEmail($data));
    }

    public function notify($data) {
        Mail::to($data->email)->send(new RegistrationEmail($data));
    }
}
