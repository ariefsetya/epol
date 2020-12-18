<?php

namespace App\Http\Controllers;

use App\Polling;
use App\PollingQuestion;
use App\PollingAnswer;
use Illuminate\Http\Request;
use Session;
use File;

class PollingQuestionController extends Controller
{

    public function index()
    {
        $data['polling_question'] = PollingQuestion::with(['polling'])->whereEventId(Session::get('event_id'))->paginate(10);
        return view('polling_question.index')->with($data);
    }
    public function create()
    {
        $data['polling'] = Polling::whereEventId(Session::get('event_id'))->get();
        return view('polling_question.add')->with($data);
    }
    public function store(Request $request)
    {
        $polling_question = PollingQuestion::create($request->all());

        $polling = Polling::find($request->input('polling_id'));

        $path = 'polling_answer/'.Session::get('event_id').'/';
        File::makeDirectory(public_path($path), $mode = 0777, true, true);
        
        foreach ($request->input('answer') as $key => $value) {
            $inv = new PollingAnswer;
            $inv->content = $value;
            if($request->file('image')!== null){
                $request->file('image')[$key]->move($path,$request->file('image')[$key]->getClientOriginalName());

                $inv->image_url = url($path.$request->file('image')[$key]->getClientOriginalName());
            }else{
                $inv->image_url = "";
            }
            $inv->polling_question_id = $polling_question->id;
            $inv->is_correct = $request->input('is_correct')[$key];
            $inv->event_id = $request->input('event_id');
            $inv->save();
        }

        return redirect()->route('polling_question.index');
    }
    public function edit($id)
    {
        $data['polling'] = Polling::whereEventId(Session::get('event_id'))->get();
        $data['polling_question'] = PollingQuestion::find($id);
        $data['polling_answer'] = PollingAnswer::where('polling_question_id',$id)->get();
        return view('polling_question.edit')->with($data);
    }
    public function update(Request $request, $id)
    {

        // dd($request->input());
        $polling_question = PollingQuestion::find($id);
        $polling_question->fill($request->all());
        $polling_question->save();

        // PollingAnswer::where('polling_question_id',$polling_question->id)->delete();

        $path = 'polling_answer/'.Session::get('event_id').'/';
        File::makeDirectory(public_path($path), $mode = 0777, true, true);

        foreach ($request->input('answer') as $key => $value) {
            $inv = new PollingAnswer;
            if($request->input('answer_id')[$key]!==null){
                $inv = PollingAnswer::find($request->input('answer_id')[$key]);
                // dd($request->input('answer_id')[$key]);
            }
            $inv->content = $value;

            if($request->file('image')[$key] !== null){
                $request->file('image')[$key]->move($path,$request->file('image')[$key]->getClientOriginalName());
                
                $inv->image_url = url($path.$request->file('image')[$key]->getClientOriginalName());
            }else if($request->input('answer_id')[$key] == null and $request->file('image')[$key] == null){
                $inv->image_url = "";
            }
            $inv->polling_question_id = $polling_question->id;
            $inv->is_correct = $request->input('is_correct')[$key];
            $inv->event_id = $request->input('event_id');
            $inv->save();
        }

        return redirect()->route('polling_question.index');
    }
    public function destroy($id)
    {
        PollingQuestion::find($id)->delete();
        return redirect()->route('polling_question.index');
    }
}
