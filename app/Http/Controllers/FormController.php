<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Form;
use App\Models\Question;
use App\Models\Subproject;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class FormController extends Controller
{
    public function index(Request $request)
    {
        //$activities = Activity::query()->where("type", 0);
        $activities = Form::query()->latest()->get();
        if ($request->ajax()) {
            return DataTables::of($activities)
                ->addColumn('name', function ($activities) {
                    if ($activities->name == null)
                        return '<p>' . $activities->activity->name . '</p>';
                    else
                        return '<p>' . $activities->name . '</p>';
                })
                ->addColumn('created_at', function ($activities) {
                    return '<p>' . \Carbon\Carbon::parse($activities->created_at)->diffForHumans() . '</p>';
                })
                ->addColumn('type', function ($activities) {
                    $status = '';
                    if ($activities->type == 0)
                        $status .= '<p class="paragraph-activity shadow hint">&nbsp;' . __("strings.activity") . '&nbsp;</p>';
                    else
                        $status .= '<p class="paragraph-subactivity shadow hint">&nbsp;' . __("strings.subactivity") . '&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($activities) {
                    if ($activities->type == 0)
                        return '<button data-id="' . $activities->activity->id . '" id="form" class="btn-outline-info rounded-2 p-1" title="form"><i class="lab la-wpforms"></i></button>&nbsp;
                               <button data-id="' . $activities->activity->id . '" id="apply" class="btn-outline-warning rounded-2 p-1" title="apply"><i class="las la-feather-alt"></i></button>&nbsp;
                               <button data-id="' . $activities->activity->id . '" data-type="' . $activities->type . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;';
                    else
                        return '<button data-id="' . $activities->id . '" id="form" class="btn-outline-info rounded-2 p-1" title="form"><i class="lab la-wpforms"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '" id="apply" class="btn-outline-warning rounded-2 p-1" title="apply"><i class="las la-feather-alt"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '"  data-type="' . $activities->type . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;';

                })
                ->rawColumns(['created_at'], ['type'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        $workers = User::query()->where('type', 2)->get();
        $subprojects = Subproject::query()->where('status', 1)->get();
        return view('forms', compact('activities', 'subprojects', 'workers'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == "create") {
                $validator = Validator::make($request->all(), [
                    'user_fk_id' => 'required:form',
                ], [
                    'user_fk_id.required' => __('strings.worker_required'),
                    // 'description.required' => __('strings.description_required'),
                ]);
                if ($validator->passes()) {
                    $workersList = $request->workers_list;
                    if ($workersList != null && count($workersList) > 0) {
                        $form = new Form();
                        $form->activity_fk_id = $request->activity_fk_id;
                        $form->subproject_fk_id = $request->subproject_fk_id;
                        $form->type = 0;
                        $form->created_at = Carbon::now();
                        $form->save();
                        $form_id = $form->id;
                        $workersList = $request->workers_list;
                        for ($i = 0; $i < count($workersList); $i++) {
                            $data = Worker::query()->create([
                                'worker_fk_id' => $workersList[$i],
                                'form_fk_id' => $form_id,
                                'created_at' => Carbon::now(),
                            ]);
                        }
                    } else {
                        return response()->json(['error' => ['user_fk_id' => __('strings.worker_required')]]);
                    }
                    return response()->json(['success' => __('strings.successfully_create_form')]);
                }
                return response()->json(['error' => $validator->errors()->toArray()]);
            }
        }
    }

    public function apply($id)
    {
        $form = Form::query()->where('activity_fk_id', $id)->get()->first();
        if (!$form)
            $form = Form::query()->find($id);
        $activity = Activity::query()->find($id);
        $questions = Question::query()->where('form_fk_id', $form->id)->get();
        return view('apply_form', compact('form', 'activity', 'questions'));
    }

    public function remove_worker($id)
    {
        $worker = Worker::query()->find($id)->delete();
        if ($worker)
            return response()->json(['success' => 'success']);
        return response()->json(['error' => 'error']);
    }


    public function add_worker(Request $request)
    {
        $old_worker = Worker::query()->where("form_fk_id", $request->form_id)->where("worker_fk_id", $request->worker_id)->get()->first();
        if (!$old_worker) {
            $worker = Worker::query()->create([
                'worker_fk_id' => $request->worker_id,
                'form_fk_id' => $request->form_id,
                'created_at' => Carbon::now(),
            ]);
            if ($worker)
                return response()->json(['success' => 'success']);
        }
        return response()->json(['error' => 'error']);

    }


    public function edit($id)
    {
        $form = Form::query()->where('activity_fk_id', $id)->get()->first();
        if (!$form)
            $form = Form::query()->find($id);
        $activity = Activity::query()->find($id);
        $questions = Question::query()->where('form_fk_id', $form->id)->get();
        $workers = User::query()->where("type", 2)->get();
        return view('edit_form', compact('form', 'activity', 'questions', 'workers'));
    }


    public function destroy($id)
    {
        $form = Form::query()->where("activity_fk_id", $id)->get()->first();
        if ($form) {
            $form->delete();
            return response()->json(['success' => 'success']);
        } else {
            $form = Form::query()->find($id);
            if ($form) {
                $form->delete();
                return response()->json(['success' => 'success']);
            } else
                return response()->json(['error' => 'error']);
        }
    }


    public function store(Request $request)
    {

    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

}
