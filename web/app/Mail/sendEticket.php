<?php

namespace App\Mail;

use Auth;
use App\EventDetail;
use Session;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendEticket extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => EventDetail::where('event_id',Session::get('event_id'))->where('name','eticket_email_from')->first()->content, 'name' => EventDetail::where('event_id',Session::get('event_id'))->where('name','eticket_email_from_name')->first()->content])
                ->subject(EventDetail::where('event_id',Session::get('event_id'))->where('name','website_title')->first()->content)
                ->view('emails.eticket')
                ->attach(public_path('/eticket/'.Session::get('event_id').'/'.Auth::user()->reg_number.'-'.Auth::user()->name.'.pdf'));
    }
}
