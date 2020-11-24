<?php

namespace App\Http\Controllers;

use App\User;
use App\Presence;
use App\Country;
use App\PollingParticipant;
use App\PollingResponse;
use App\ProductResponse;
use App\RSVP;
use DB;
use Auth;
use File;
use Session;
use Illuminate\Http\Request;
use App\Imports\InvitationImport;
use App\Exports\PresenceExport;
use Maatwebsite\Excel\Facades\Excel;

class InvitationController extends Controller
{

    public function index()
    {
        $data['user'] = User::where('event_id',Session::get('event_id'))->with(['country'])->get();
        return view('user.index')->with($data);
    }
    public function create()
    {
        $data['country'] = Country::all();
        return view('user.add')->with($data);
    }
    public function store(Request $request)
    {
        User::create($request->all());

        return redirect()->route('user.index');
    }
    public function edit($id)
    {
        $data['country'] = Country::all();
        $data['user'] = User::where('event_id',Session::get('event_id'))->whereId($id)->first();
        return view('user.edit')->with($data);
    }
    public function update(Request $request, $id)
    {
        $inv = User::where('event_id',Session::get('event_id'))->whereId($id)->first();
        $inv->fill($request->all());
        $inv->save();

        return redirect()->route('user.index');
    }
    public function destroy($id)
    {
        User::where('event_id',Session::get('event_id'))->whereId($id)->delete();
        return redirect()->route('user.index');
    }
    public function report()
    {
        $x = new PresenceExport;
        $data['presence'] = $x->collection();
        return view('user.report')->with($data);
    }
    public function export_excel()
    {
        return Excel::download(new PresenceExport, 'laporan_kehadiran.xlsx');
    }
    public function clear($id)
    {
        $inv = User::where('event_id',Session::get('event_id'))->whereId($id)->first();
        $inv->need_login = 1;
        $inv->save();

        Presence::where('event_id',Session::get('event_id'))->where('user_id',$id)->delete();

        return redirect()->route('user.index');
    }
    public function reset()
    {
        User::where('event_id',Session::get('event_id'))->where('user_type_id','2')->delete();
        Presence::where('event_id',Session::get('event_id'))->delete();
        PollingParticipant::where('event_id',Session::get('event_id'))->delete();
        PollingResponse::where('event_id',Session::get('event_id'))->delete();
        RSVP::where('event_id',Session::get('event_id'))->delete();

        return redirect()->route('user.index');
    }
    public function import()
    {
        return view('user.import');
    }
    public function process_import(Request $r)
    {
        if($r->input('import_type')==2){
            User::where('event_id',Session::get('event_id'))->where('user_type_id','2')->delete();
            Presence::where('event_id',Session::get('event_id'))->delete();
            PollingParticipant::where('event_id',Session::get('event_id'))->delete();
            PollingResponse::where('event_id',Session::get('event_id'))->delete();
            RSVP::where('event_id',Session::get('event_id'))->delete();
        }

        $exc = Excel::import(new InvitationImport, request()->file('excel_file'));

        return redirect()->route('user.index');
    }

    public function register_face()
    {
        return view('auth.register_face');
    }

    public function show($id)
    {
        # code...
    }

    public function process_register_face(Request $r)
    {
        $image = $r->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = Auth::user()->id;

        File::makeDirectory(public_path(). '/models/' . $imageName, $mode = 0777, true, true);
        File::put(public_path(). '/models/' . $imageName.'/1.png', base64_decode($image));

        $inv = User::find(Auth::user()->id);
        $inv->custom_field_3 = 1;
        $inv->save();

        return response()->json([
            'message'=>'Success'
        ],200);
    }
    public function check_id(Request $r)
    {
        $id = explode(" ",$r->input('id'));
        $inv = User::find($id[0]);
        return response()->json([
            'message'=>'Success',
            'result'=>$inv
        ],200);
    }
    public function check_in_face()
    {
        return view('auth.check_in_face');
    }

}
