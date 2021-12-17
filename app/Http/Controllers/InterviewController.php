<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Answer;
use App\Models\Form;
use App\Models\Interview;
use App\Models\Question;
use App\Models\Subproject;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InterviewController extends Controller
{

    public function index(Request $request)
    {
        $interviews = Interview::query()->latest()->get();
        if ($request->ajax()) {
            return DataTables::of($interviews)
                ->addColumn('customer_location', function ($activities) {
                    return '<p class="hint paragraph-admin">' . $activities->customer_location . '</p>';
                })
                ->addColumn('created_at', function ($activities) {
                    return '<p>' . \Carbon\Carbon::parse($activities->created_at)->diffForHumans() . '</p>';
                })
                ->addColumn('action', function ($interviews) {
                    $button = '<button data-id="' . $interviews->id . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>&nbsp;&nbsp;
                               <button data-id="' . $interviews->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;';
                    return $button;
                })
                ->rawColumns(['created_at'], ['customer_location'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        return view('activities', compact('interviews'));
    }

    public function show($id)
    {
        $interview = Interview::find($id);
        $form = Form::query()->find($interview->form_fk_id);
        $activity = Activity::query()->find($form->activity_fk_id);
        //dd($interview->form_fk_id);
        $questions = Question::query()->where('form_fk_id',$interview->form_fk_id)->get();
        $answers = Answer::query()->where('interview_fk_id',$id)->get();
        return view('view_interview', compact('interview','form', 'activity', 'questions', 'answers'));
        //return view('view_interview', compact('interview'));
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $interview = Interview::query()->find($id)->delete();
            $answers = Answer::query()->where('interview_fk_id', $id)->delete();
            return response()->json(['success' => 'Success removed']);
        }
        return response()->json(['error' => 'not removed']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

}
