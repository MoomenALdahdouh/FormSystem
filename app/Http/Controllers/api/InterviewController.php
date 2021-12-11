<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Interview;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class InterviewController extends Controller
{

    public function index()
    {
        $interviews = Interview::query()->latest()->get();
        return $interviews;
    }


    public function create(Request $request)
    {
        $data = new Interview();
        $data->title = $request->title;
        $data->form_fk_id = $request->form_fk_id;
        $data->created_at = Carbon::now();
        $data->updated_at = Carbon::now();
        $data->customer_location = $request->customer_location;
        $data->save();
        //$this->save_questions($interview_id, $request->questions);
        if ($data) {
            $interview_id = $data->id;
            return response()->json(['interview_id' => $interview_id]);
        }
    }

    public function show($id)
    {
        $interview = Interview::query()->find($id);
        $answers = $interview->answers;
        return $answers;
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
