<?php

namespace App\Http\Controllers;

use App\Polling;
use App\PollingType;
use App\PollingResponse;
use App\PollingQuestion;
use App\PollingParticipant;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Exports\PollingEssayExport;
use Maatwebsite\Excel\Facades\Excel;

class PollingController extends Controller
{

    public function index()
    {
        $data['polling'] = Polling::where('event_id',Session::get('event_id'))->with(['polling_type'])->paginate(10);
        return view('polling.index')->with($data);
    }
    public function create()
    {
        $data['polling_type'] = PollingType::all();
        return view('polling.add')->with($data);
    }
    public function store(Request $request)
    {
        Polling::create($request->all());

        return redirect()->route('polling.index');
    }
    public function edit($id)
    {
        $data['polling_type'] = PollingType::all();
        $data['polling'] = Polling::where('event_id',Session::get('event_id'))->whereId($id)->first();
        return view('polling.edit')->with($data);
    }
    public function show($id)
    {
        $data['polling'] = Polling::where('event_id',Session::get('event_id'))->whereId($id)->first();
        $arr = [];
        foreach (PollingQuestion::where('event_id',Session::get('event_id'))->where('polling_id',$id)->get() as $key) {

            $key['polling_response'] = PollingResponse::select(DB::raw('id, polling_answer_id, count(id) as total'))->where('event_id',Session::get('event_id'))->where('polling_question_id',$key->id)->with(['polling_answer'])->groupBy('polling_answer_id')->get();
            $arr[] = $key;
        }
        // dd($arr);
        $data['result'] = $arr;
        return view('polling.show')->with($data);
    }
    public function detail($polling_id,$question_id)
    {
        $data['polling'] = Polling::where('event_id',Session::get('event_id'))->whereId($polling_id)->first();
        $data['polling_question'] = PollingQuestion::where('event_id',Session::get('event_id'))->whereId($question_id)->first();

        $data['polling_response'] = PollingResponse::select(DB::raw('id, polling_answer_id, count(id) as total'))->where('event_id',Session::get('event_id'))->where('polling_question_id',$question_id)->with(['polling_answer'])->groupBy('polling_answer_id')->get();
        return view('polling.detail')->with($data);
    }
    public function update(Request $request, $id)
    {
        $inv = Polling::where('event_id',Session::get('event_id'))->whereId($id)->first();
        $inv->fill($request->all());
        $inv->save();

        return redirect()->route('polling.index');
    }
    public function destroy($id)
    {
        Polling::where('event_id',Session::get('event_id'))->whereId($id)->delete();
        return redirect()->route('polling.index');
    }
    public function report()
    {
        $data['polling'] = Polling::where('event_id',Session::get('event_id'))->get();
        return view('polling.report')->with($data);
    }
    public function polling_response_reset($polling_id, $user_id)
    {
        PollingResponse::where('event_id',Session::get('event_id'))->where('polling_id',$polling_id)->where('user_id',$user_id)->delete();
        PollingParticipant::where('event_id',Session::get('event_id'))->where('polling_id',$polling_id)->where('user_id',$user_id)->delete();
        return redirect()->route('quiz_report',[$polling_id]);
    }
    public function polling_setting()
    {
        return view('polling.setting');
    }
    public function display()
    {
        return view('quiz_response.display');
    }
    public function display_report($id)
    {
        $report = PollingParticipant::withCount(['polling_response'=>function($query) use ($id)
        {
            $query->whereEventId(Session::get('event_id'))->wherePollingId($id)->whereIsWinner(1);
        }])->whereEventId(Session::get('event_id'))->wherePollingId($id)->get();

        $arr = [];
        foreach ($report as $key) {
            $arr[] = [
                'name'=>$key->user->name,
                'company'=>$key->user->company,
                'polling_response_count'=>(int)$key->polling_response_count,
                'created_at'=>$key->created_at,
            ];
        }

        $collection = collect($arr);
        $xcol = $collection->sortByDesc('polling_response_count')->take(10)->values();

        $data['report'] = $xcol;

        return view('quiz_response.display_report')->with($data);
    }
    public function polling_essay_report($id)
    {
        $data['polling'] = Polling::find($id);
        $data['polling_response'] = PollingResponse::where('event_id',Session::get('event_id'))->where('polling_id',$id)->get();

        return view('quiz_response.polling_essay_report')->with($data);
    }
    public function polling_essay_export_excel($id)
    {
        $polling = Polling::whereId($id)->first();
        $exporter = app()->makeWith(PollingEssayExport::class, compact('id')); 
        return Excel::download($exporter,'laporan_polling_essay_'.$polling->name.'.xlsx');
    }
}
