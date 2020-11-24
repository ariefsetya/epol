<?php

namespace App\Http\Controllers;

use App\EventDetail;
use Session;
use Illuminate\Http\Request;

class EventDetailController extends Controller
{
    public function index()
    {
        $data['event_detail'] = EventDetail::where('event_id',Session::get('event_id'))->get();
        return view('event_detail.index')->with($data);
    }
    public function create()
    {
        return view('event_detail.add');
    }
    public function store(Request $request)
    {
        EventDetail::create($request->all());

        return redirect()->route('event_detail.index');
    }
    public function edit($id)
    {
        $data['event_detail'] = EventDetail::where('event_id',Session::get('event_id'))->whereId($id)->first();
        return view('event_detail.edit')->with($data);
    }
    public function update(Request $request, $id)
    {
        $inv = EventDetail::where('event_id',Session::get('event_id'))->whereId($id)->first();

        if($inv->type=='text'){
            $inv->fill($request->all());
        }
        else if($inv->type=='image'){
            $file = $request->file('content');

            $path = 'img/'.Session::get('event_id').'/';
     
                    // upload file
            $file->move($path,$file->getClientOriginalName());
            $data = $request->all();
            $data['content'] = url($path.$file->getClientOriginalName());
            $inv->fill($data);

        }
        $inv->save();

        return redirect()->route('event_detail.index');
    }
    public function destroy($id)
    {
        EventDetail::where('event_id',Session::get('event_id'))->whereId($id)->delete();
        return redirect()->route('event_detail.index');
    }
}
