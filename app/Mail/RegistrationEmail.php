<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Notification;

class RegistrationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $path, $username, $password)
    {
        $this->data = $data;
        $this->path = $path;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS', 'admin@intipesan.com'))
                ->subject($this->data->subject)
                ->view('mail.registration')
                ->with('data', $this->data)
                ->with('path', $this->path)
                ->with('username', $this->username)
                ->with('password', $this->password);
    }
}
