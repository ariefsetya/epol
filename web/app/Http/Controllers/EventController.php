<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\EventDetail;
use App\User;
use App\RSVP;
use Str;
use Session;

class EventController extends Controller
{
	public function create_event($name,$location,$date)
	{
		$evt = Event::create([
			'code'=>Str::slug($name),
			'name'=>$name,
			'location'=>$location,
			'date'=>$date,
		]);

		$data = [
			['event_id'=>$evt->id,'type'=>'text','name'=>'success_login','content'=>'Berhasil masuk', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'failed_login','content'=>'Silahkan ulangi atau hubungi panitia', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'next_survey_button','content'=>'SELANJUTNYA', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'finish_survey_button','content'=>'SELESAI', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'finish_survey_alert','content'=>'TERIMA KASIH TELAH MENGIKUTI SURVEY', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'already_login','content'=>'Anda sudah login pada device lain', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'invitation_total','content'=>'250', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'idle','content'=>'0', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'greeting_text','content'=>'Welcome', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'logout_button_visibility','content'=>'1', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'website_title','content'=>'Your '.$name.' Website', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'image','name'=>'website_header_logo','content'=>'https://core.e-guestbook.com/img/HEADER.png', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'image','name'=>'website_footer_logo','content'=>'https://core.e-guestbook.com/img/FOOTER.png', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'image','name'=>'website_background_image','content'=>'https://core.e-guestbook.com/img/BACKGROUND.png', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'image','name'=>'website_overlay_background','content'=>'https://core.e-guestbook.com/img/FOOTER.png', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'mode','content'=>'register_barcode', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'barcode_url','content'=>'https://e-guestbook.com:3030/?bcid=qrcode&scale=5&text=', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'barcode_email_body','content'=>'Your QR Code attached.', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'barcode_email_subject','content'=>'Your QR Code', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'barcode_email_from','content'=>'eguestbook@gmail.com', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'barcode_email_from_name','content'=>'E-Guestbook', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'barcode_success_message','content'=>'REGISTRATION SUCCESS!', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'barcode_email_sent_message','content'=>'QR code is sent to your e-mail', 'choices'=>''],
			['event_id'=>$evt->id,'type'=>'text','name'=>'login_first','content'=>'1', 'choices'=>''],
		];

		foreach ($data as $key) {
			EventDetail::create($key);
		}

		$inv = [
			'event_id'=>$evt->id,
			'name'=>'Administrator',
			'reg_number'=>'0000',
			'country_id'=>'100',
			'phone'=>'83870002220',
			'company'=>'Event Corp.',
			'email'=>'eventwebsiteid@gmail.com',
			'need_login'=>1,
			'user_type_id'=>1,
			'custom_field_1'=>'', 'custom_field_2'=>'', 'custom_field_3'=>''
		];

		$user = User::create($inv);
		$user->save();

		$rsvp = new RSVP;
		$rsvp->event_id = Session::get('event_id');
		$rsvp->user_id = $user->id;
		$rsvp->seat_number = 0;
		$rsvp->session_invitation = '';
		$rsvp->event_time = '';
		$rsvp->save();

		$data['event'] = $evt;
		$data['detail'] = $data;
		$data['user'] = $inv;
		$data['rsvp'] = $rsvp;

		return response()->json($data);

	}
}
