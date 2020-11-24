<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LotteryController extends Controller
{
	public function upload_csv(Request $r)
	{

		$file = $r->file('f');
		$ext = $file->getClientOriginalExtension();
		$filename = uniqid().".{$ext}";
		$file->move(base_path()."/../data/", $filename);
		return ['status'=>'OK','filename'=>$filename];
	}
	public function display()
	{
		return view('scan.display');
	}
	public function participant_category()
	{
		return view('participant_category.list');
	}
	public function participant()
	{
		return view('participant.list');
	}
	public function scan()
	{
		return view('scan.lottery');
	}
	public function core()
	{
		return view('welcome');
	}
}
