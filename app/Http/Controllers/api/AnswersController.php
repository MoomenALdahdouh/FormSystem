<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use Illuminate\Http\Request;

class AnswersController extends Controller
{

    public function index()
    {
        $answers = Answer::query()->latest()->get();
        return $answers;
    }

    public function create(Request $request)
    {
        $answersList = $request->answersList;
        foreach ($answersList as $answer) {
            $data = Answer::query()->create([
                'questions_fk_id' => $answer["questions_fk_id"],
                'interview_fk_id' => $answer["interview_fk_id"],
                'answer' => $answer["answer"],
            ]);
        }
        return response()->json(['success' => 'success submit']);
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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
