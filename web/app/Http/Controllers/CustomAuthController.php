<?php

namespace App\Http\Controllers;

use Auth;
use App\Presence;
use App\EventDetail;
use App\User;
use Session;
use Validator;
use Illuminate\Http\Request;
use App\Mail\sendEticket;
use PDF;
use File;
use Mail;

class CustomAuthController extends Controller
{
	public function registerPage()
	{
		return view('auth.register');
	}
	public function register_user(Request $r)
	{
		$validator = Validator::make($r->all(), [
			'name' => 'required|max:255',
			'email' => 'required|unique:users',
			'phone' => 'required|unique:users',
		], [
			'name.required' => 'Kolom Nama harus diisi.',
			'email.required' => 'Kolom Email harus diisi.',
			'phone.required' => 'Kolom Nomor WhatsApp harus diisi.',
			'email.unique' => 'Email yang Anda isi sudah terdaftar.',
			'phone.unique' => 'Nomor WhatsApp yang Anda isi sudah terdaftar.',
		]);

		if ($validator->fails()) {
			return redirect(route('register'))
			->withErrors($validator)
			->withInput();
		}
		$last = User::orderBy('id','desc')->first();
		if(isset($last->reg_number)){
			if($last->reg_number==''){
				$last = str_pad(1, 4, '0', STR_PAD_LEFT);
			}else{
				$last = str_pad(++$last->reg_number, 4, '0', STR_PAD_LEFT);
			}
		}else{
			$last = str_pad(1, 4, '0', STR_PAD_LEFT);
		}

		$data = $r->all();
		$data['reg_number'] = $last;
		$data['user_type_id'] = 2;

		$inv = User::create($data);

		Auth::loginUsingId($inv->id);

		sendEmailEticket();

		return redirect()->route('home');
	}

	public function removeRedirectToHome()
	{
		return redirect()->route('home');
	}


    public function sendEmailEticket()
    {
        File::makeDirectory(public_path('/eticket/'.Session::get('event_id').'/'), $mode = 0777, true, true);
        $pdf = PDF::loadView('print_eticket')->setPaper([0,0,1000,1497], 'potrait');
        $pdf->save(public_path('/eticket/'.Session::get('event_id').'/'.Auth::user()->reg_number."-".Auth::user()->name.'.pdf'));
        Mail::to(Auth::user()->email)->send(new sendEticket());
        return redirect()->route('home')->with('success','E-ticket sudah dikirim ke email Anda');
    }

	public function phoneLogin(Request $r)
	{	
		if(\App\EventDetail::where('event_id',Session::get('event_id'))->where('name','mode')->first()->content=='rsvp'){
			$country_id = $r->input('country_id');
			$phone = ltrim($r->input('phone'),"0");
			if(strlen(trim($phone))==0){
				return redirect()->route('loginPage')->with(['message'=>'Nomor Telepon harus diisi']);
			}
			if(User::where('event_id',Session::get('event_id'))->where(['country_id'=>$country_id,'phone'=>$phone])->exists()){
				$user = User::where('event_id',Session::get('event_id'))->where(['country_id'=>$country_id,'phone'=>$phone])->first();

				if($user->user_type_id==1){

					Auth::loginUsingId($user->id);

					$inv = User::where('event_id',Session::get('event_id'))->whereId($user->id)->first();
					$inv->need_login = 0;
					$inv->save();

					return redirect()->route('admin')->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('success_login')->first()->content]);

				}else if($user->user_type_id==2){

					if(Presence::where('user_id',$user->id)->exists() and $user->need_login==0){

						return redirect()->route('loginPage')->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('already_login')->first()->content]);

					}else{

						Auth::loginUsingId($user->id);

						$inv = User::where('event_id',Session::get('event_id'))->whereId($user->id)->first();
						$inv->need_login = 0;
						$inv->save();

						return redirect()->route('home')->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('success_login')->first()->content]);
					}
				}
			}else{
				return redirect()->route('loginPage',[1])->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('failed_login')->first()->content]);
			}
		}
		else{
			$code = trim($r->input('code'));
			if(strlen(trim($code))==0){
				return redirect()->route('loginPage')->with(['message'=>'Kode Undangan harus diisi']);
			}
			if(User::where('event_id',Session::get('event_id'))->where(['reg_number'=>$code])->exists()){
				$user = User::where('event_id',Session::get('event_id'))->where(['reg_number'=>$code])->first();
				
				if($user->user_type_id==1){
					
					Auth::loginUsingId($user->id);

					$inv = User::where('event_id',Session::get('event_id'))->whereId($user->id)->first();
					$inv->need_login = 0;
					$inv->save();
					
					return redirect()->route('admin')->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('success_login')->first()->content]);

				}else if($user->user_type_id==2){

					if(Presence::where('user_id',$user->id)->exists() and $user->need_login==0){

						return redirect()->route('loginPage')->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('already_login')->first()->content]);

					}else{

						Auth::loginUsingId($user->id);

						$inv = User::where('event_id',Session::get('event_id'))->whereId($user->id)->first();
						$inv->need_login = 0;
						$inv->save();

						return redirect()->route('home')->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('success_login')->first()->content]);
					}
				}
			}else{
				return redirect()->route('loginPage',[1])->with(['message'=>EventDetail::where('event_id',Session::get('event_id'))->whereName('failed_login')->first()->content]);
			}
		}
	}
	public function loginPage()
	{	
		if(Auth::check()){
			return redirect()->route('home');
		}
		$data['country'] = \App\Country::all();
		return view('auth.login')->with($data);
	}
	public function logout()
	{
		if(Auth::check()){

			$inv = User::where('event_id',Session::get('event_id'))->whereId(Auth::user()->id)->first();
			$inv->need_login = 1;
			$inv->save();

			Auth::logout();

		}

		Session::flush();

		return redirect()->route('home');
	}
}
