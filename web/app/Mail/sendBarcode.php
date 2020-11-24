<?php

namespace App\Mail;

use Auth;
use App\EventDetail;
use Session;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendBarcode extends Mailable
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
        return $this->from(['address' => EventDetail::where('event_id',Session::get('event_id'))->where('name','barcode_email_from')->first()->content, 'name' => EventDetail::where('event_id',Session::get('event_id'))->where('name','barcode_email_from_name')->first()->content])
                ->subject(EventDetail::where('event_id',Session::get('event_id'))->where('name','website_title')->first()->content)
                ->view('emails.barcode')
                ->attach(public_path('/pdf/'.Session::get('event_id').'/'.Auth::user()->name.'.pdf'));
    }
}
