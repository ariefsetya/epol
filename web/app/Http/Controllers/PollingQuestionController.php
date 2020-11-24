<?php

namespace App\Http\Controllers;

use App\Polling;
use App\PollingQuestion;
use App\PollingAnswer;
use Illuminate\Http\Request;

class PollingQuestionController extends Controller
{

    public function index()
    {
        $data['polling_question'] = PollingQuestion::with(['polling'])->paginate(10);
        return view('polling_question.index')->with($data);
    }
    public function create()
    {
        $data['polling'] = Polling::all();
        return view('polling_question.add')->with($data);
    }
    public function store(Request $request)
    {
        $polling_question = PollingQuestion::create($request->all());

        foreach ($request->input('answer') as $key => $value) {
            $inv = new PollingAnswer;
            $inv->content = $key;
            $inv->polling_question_id = $polling_question->id;
            $inv->is_correct = $request->input('is_correct')[$key];
            $inv->event_id = $request->input('event_id');
            $inv->save();
        }

        return redirect()->route('polling_question.index');
    }
    public function edit($id)
    {
        $data['polling'] = Polling::all();
        $data['polling_question'] = PollingQuestion::find($id);
        $data['polling_answer'] = PollingAnswer::where('polling_question_id',$id)->get();
        return view('polling_question.edit')->with($data);
    }
    public function update(Request $request, $id)
    {
        $polling_question = PollingQuestion::find($id);
        $polling_question->fill($request->all());
        $polling_question->save();

        PollingAnswer::where('polling_question_id',$polling_question->id)->delete();

        foreach ($request->input('answer') as $key => $value) {
            $inv = new PollingAnswer;
            $inv->content = $value;
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
