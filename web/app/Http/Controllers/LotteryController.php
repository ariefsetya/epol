<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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
	public function operator()
	{
		return view('lottery.operator');
	}
	public function apps()
	{
		return view('lottery.apps');
	}
	public function winners()
	{
		$data = \App\LotteryParticipant::select(DB::raw('concat(number, "|" ,name) as name'))->orderBy(DB::raw('rand()'))->limit(10)->get()->pluck('name')->toArray();
		return implode("-", $data);
	}
}
