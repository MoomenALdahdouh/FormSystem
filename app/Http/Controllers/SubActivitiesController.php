<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Form;
use App\Models\SubActivities;
use App\Models\Subproject;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class SubActivitiesController extends Controller
{
    public function index(Request $request)
    {
        $activities = Activity::query()->where("type", 1);
        if ($request->ajax()) {
            return DataTables::of($activities)
                ->addColumn('subproject', function ($activities) {
                    return '<span>' . $activities->subproject->name . '</span>';
                })
                ->addColumn('created_at', function ($activities) {
                    return '<p>' . \Carbon\Carbon::parse($activities->created_at)->diffForHumans() . '</p>';
                })
                ->addColumn('type', function ($activities) {
                    $type = '<p class="paragraph-admin shadow hint">&nbsp;' . __("strings.form") . '&nbsp;</p>';
                    switch ($activities->type) {
                        case 0:
                            $type = '<p class="activity-type shadow hint">&nbsp; ' . __("strings.form") . ' &nbsp;</p>';
                            break;
                        case 1:
                            $type = '<p class="paragraph-manager shadow hint">' . __("strings.subactivity") . '</p>';
                            break;
                    }
                    return $type;
                })
                ->addColumn('status', function ($activities) {
                    $status = '';

                    if ($activities->status == 0)
                        $status .= '<p class="paragraph-pended shadow hint">&nbsp;' . __("strings.pended") . '&nbsp;</p>';
                    else
                        $status .= '<p class="paragraph-active shadow hint">&nbsp;' . __("strings.active") . '&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($activities) {
                    $button = '<button data-id="' . $activities->id . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '#edit-activity' . '" data-type="' . $activities->type . '" id="edit" class="btn-outline-dark rounded-2 p-1" title="settings"><i class="las la-cog"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '" data-type="' . $activities->type . '" id="view" class="btn-outline-primary rounded-2 p-1" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['subproject'],  ['created_at'], ['type'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        $workers = User::query()->where('type', 2)->get();
        $subprojects = Subproject::query()->where('status', 1)->get();
        $subactivities = Activity::query()->where("type", 1)->get();
        return view('subactivities', compact('activities', 'subprojects', 'workers', 'subactivities'));
    }

    public function forms(Request $request, $id)
    {
        $activities = Form::query()->where("activity_fk_id", $id);
        if ($request->ajax()) {
            return DataTables::of($activities)
                ->addColumn('created_at', function ($activities) {
                    return '<p>' . \Carbon\Carbon::parse($activities->created_at)->diffForHumans() . '</p>';
                })
                ->addColumn('status', function ($activities) {
                    $status = '';

                    if ($activities->status == 0)
                        $status .= '<p class="paragraph-pended shadow hint">&nbsp; ' . __("strings.pended") . '&nbsp;</p>';
                    else
                        $status .= '<p class="paragraph-active shadow hint">&nbsp;' . __("strings.active") . '&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($activities) {
                    return '<button data-id="' . $activities->id . '" id="form" class="btn-outline-info rounded-2 p-1" title="form"><i class="lab la-wpforms"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '" id="apply" class="btn-outline-warning rounded-2 p-1" title="apply"><i class="las la-feather-alt"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '"  data-type="' . $activities->type . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;';

                })
                ->rawColumns(['created_at'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        $workers = User::query()->where('type', 2)->get();
        $subprojects = Subproject::query()->where('status', 1)->get();
        return view('view_subactivity', compact('activities', 'subprojects', 'workers'));
    }

    public function all(Request $request)
    {
        if ($request->ajax()) {
            $subproject = Subproject::query()->find($request->subproject_id);
            //$project = Subproject::query()->latest()->get();
            return view('pagination_activities', compact('subproject'))->render();
        }
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == "create") {
                $data = new SubActivities();
                $data->activity_fk_id = $request->activity_fk_id;
                $data->subproject_fk_id = $request->subproject_fk_id;
                $data->created_at = Carbon::now();
                $data->save();
                $subactivity_fk_id = $data->id;
                //$this->createForm($activity_fk_id, $request->worker, $request->subproject);
                return response()->json(['success' => __('strings.created_user'), 'subactivity_fk_id' => $subactivity_fk_id]);
                //return response()->json(['error' => $validator->errors()->all()]);
            }
        }
    }

    public function createForm(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == "create") {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:form|max:255',
                    'user_fk_id' => 'required:form',
                ], [
                    'name.required' => __('strings.name_required'),
                    'user_fk_id.required' => __('strings.worker_required'),
                    // 'description.required' => __('strings.description_required'),
                ]);
                if ($validator->passes()) {
                    $workersList = $request->workers_list;
                    if ($workersList != null && count($workersList) > 0) {
                        $data = new Form();
                        $data->activity_fk_id = $request->subactivity_fk_id;
                        $data->name = $request->name;
                        // $data->description = $request->description;
                        $data->status = $request->status;
                        $data->type = 1;
                        $data->created_at = Carbon::now();
                        $data->save();
                        $form_id = $data->id;
                        $subactivity_fk_id = $data->id;

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

                    //$this->createForm($activity_fk_id, $request->worker, $request->subproject);
                    return response()->json(['success' => __('strings.created_user'), 'subactivity_fk_id' => $subactivity_fk_id]);
                    //return response()->json(['error' => $validator->errors()->all()]);
                }
                return response()->json(['error' => $validator->errors()->toArray()]);
            }
        }
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $activity = Activity::find($id);
        return view('view_subactivity', compact('activity'));
    }

    public function edit($id)
    {
        $activity = Activity::find($id);
        return view('edit_activity', compact('activity'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->action == "update") {
                $update = Activity::query()->find($id);
                $update->name = $request->name;
                $update->description = $request->description;
                $update->status = $request->status;
                $update->save();
                /* $update = Activity::query()->find($id)->update([
                     'name' => $request->name,
                     'description' => $request->description,
                     'status' => $request->status,
                 ]);*/
                if ($update)
                    return response()->json(['success' => __('strings.successfully_update_project')]);
                else
                    return response()->json(['error' => __('strings.field_update_project')]);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $activity = Activity::query()->find($id);
            $form = Form::query()->where('activity_fk_id', $id);
            if ($form->delete() && $activity->delete()) {
                return response()->json(['success' => __('strings.successfully_delete_project')]);
            }
            return response()->json(['error' => 'strings.field_delete_activity']);
        }
    }
}
