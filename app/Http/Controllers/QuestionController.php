<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $questions = Question::query()->where('form_fk_id', $request->form_fk_id)->orderBy('questions_key','ASC')->get();
            return response()->json(['success' => $questions]);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        if ($request->ajax()) {
            $questionsList = $request->questionsList;
            $questions = Question::query()->where('form_fk_id', $request->form_fk_id)->get();
            foreach ($questions as $question) {
                $question->delete();
            }
            foreach ($questionsList as $question) {
                $data = Question::query()->create([
                    'form_fk_id' => $question["form_fk_id"],
                    'questions_key' => $question["questions_key"],
                    'title' => $question["title"],
                    'body' => $question["body"],
                    'type' => $question["type"],
                ]);
            }
            return response()->json(['success' => 'success']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

}
