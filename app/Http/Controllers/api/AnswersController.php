<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    public function index()
    {
        $answers = Answer::query()->get();
        return $answers;
    }

    public function upload(Request $request)
    {
        return ['result' => "fdf"];
    }

    public function create(Request $request)
    {
        $answersList = $request->answersList;
        foreach ($answersList as $answer) {
            $answer_image = time() . '.jpg';
            if ($answer["type"] == 4) {//image
                file_put_contents('storage/answer_images/' . $answer_image, base64_decode($answer["answer"]));
                $answer["answer"] = $answer_image;
            }
            $data = Answer::query()->create([
                'questions_fk_id' => $answer["questions_fk_id"],
                'interview_fk_id' => $answer["interview_fk_id"],
                'answer' => $answer["answer"],
                'type' => $answer["type"],
            ]);
        }
        return response()->json(['success' => 'success submit']);
    }

    public function addAnswer(Request $request)
    {
        $data = new Answer();
        $data->questions_fk_id = $request->questions_fk_id;
        $data->interview_fk_id = $request->interview_fk_id;
        $data->answer = $request->answer;
        $data->save();
        if ($data) {
            return response()->json(['success' => 'success submit']);
        }
    }


    public function update(Request $request)
    {
        $answersList = $request->answersList;
        foreach ($answersList as $answer) {
            $answer_id = $answer["id"];
            $oldAnswer = Answer::query()->find($answer_id);
            /*$oldAnswer->answer = $answer["answer"];
            $oldAnswer->save();*/
            $data = $oldAnswer->update([
                'answer' => $answer["answer"],
            ]);
        }
        return response()->json(['success' => 'success update']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
