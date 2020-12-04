<?php

namespace App\Http\Controllers;

use App\LotteryProperty;
use Session;
use Illuminate\Http\Request;

class LotteryPropertyController extends Controller
{
	public function index()
	{
		$data['lottery_property'] = LotteryProperty::where('event_id',Session::get('event_id'))->get();
		return view('lottery_property.index')->with($data);
	}
	public function create()
	{
		return view('lottery_property.add');
	}
	public function store(Request $request)
	{
		$path = 'img/'.Session::get('event_id').'/';
		$data = $request->all();
		unset($data['_token']);
		if($request->hasFile('report_image_url')){
			$report_image_url = $request->file('report_image_url');
			$report_image_url->move($path,$report_image_url->getClientOriginalName());
			$data['report_image_url'] = url($path.$report_image_url->getClientOriginalName());
		}
		if($request->hasFile('display_image_url')){
			$display_image_url = $request->file('display_image_url');
			$display_image_url->move($path,$display_image_url->getClientOriginalName());
			$data['display_image_url'] = url($path.$display_image_url->getClientOriginalName());
		}
		LotteryProperty::create($data);

		return redirect()->route('lottery_property.index');
	}
	public function edit($id)
	{
		$data['lottery_property'] = LotteryProperty::where('event_id',Session::get('event_id'))->whereId($id)->first();
		return view('lottery_property.edit')->with($data);
	}
	public function update(Request $request, $id)
	{
		$inv = LotteryProperty::where('event_id',Session::get('event_id'))->whereId($id)->first();

		$path = 'img/'.Session::get('event_id').'/';
		$data = $request->all();
		if($request->hasFile('report_image_url')){
			$report_image_url = $request->file('report_image_url');
			$report_image_url->move($path,$report_image_url->getClientOriginalName());
			$data['report_image_url'] = url($path.$report_image_url->getClientOriginalName());
		}
		if($request->hasFile('display_image_url')){
			$display_image_url = $request->file('display_image_url');
			$display_image_url->move($path,$display_image_url->getClientOriginalName());
			$data['display_image_url'] = url($path.$display_image_url->getClientOriginalName());
		}
		$inv->fill($data);

		$inv->save();

		return redirect()->route('lottery_property.index');
	}
	public function destroy($id)
	{
		LotteryProperty::where('event_id',Session::get('event_id'))->whereId($id)->delete();
		return redirect()->route('lottery_property.index');
	}
	public function show()
	{
		$data['lottery_property'] = LotteryProperty::where('event_id',Session::get('event_id'))->get();
		return view('lottery_property.index')->with($data);
	}
}
