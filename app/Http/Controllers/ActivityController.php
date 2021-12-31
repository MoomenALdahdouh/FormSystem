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

//TODO:: MOOMEN S. ALDAHDOUH 12/1/2021
class ActivityController extends Controller
{

    public function index(Request $request)
    {
        $activities = Activity::query()->latest()->get();
        if ($request->ajax()) {
            return DataTables::of($activities)
                /*->addColumn('worker', function ($activities) {
                    return '<span>' . $activities->worker->name . '</span>';
                })*/
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
                    if ($activities->type == 0)
                        $button = '<button data-id="' . $activities->id . '" id="form" class="btn-outline-info rounded-2 p-1" title="form"><i class="lab la-wpforms"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '" id="apply" class="btn-outline-warning rounded-2 p-1" title="apply"><i class="las la-feather-alt"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '#edit-activity' . '" data-type="' . $activities->type . '" id="edit" class="btn-outline-dark rounded-2 p-1" title="settings"><i class="las la-cog"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '" data-type="' . $activities->type . '" id="view" class="btn-outline-primary rounded-2 p-1" title="view"><i class="las la-external-link-alt"></i></button>';
                    else{
                        $button = '<button data-id="' . $activities->id . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '#edit-activity' . '" data-type="' . $activities->type . '" id="edit" class="btn-outline-dark rounded-2 p-1" title="settings"><i class="las la-cog"></i></button>&nbsp;
                               <button data-id="' . $activities->id . '" data-type="' . $activities->type . '" id="view" class="btn-outline-primary rounded-2 p-1" title="view"><i class="las la-external-link-alt"></i></button>';

                    }
                    return $button;
                })
                ->rawColumns(['subproject'], ['created_at'], ['type'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        $workers = User::query()->where('type', 2)->get();
        $subprojects = Subproject::query()->where('status', 1)->get();
        return view('activities', compact('activities', 'subprojects', 'workers'));
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
                $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:activities|max:255',
                    'description' => 'required',
                ], [
                    'name.required' => __('strings.name_required'),
                    'description.required' => __('strings.description_required'),
                ]);


                if ($validator->passes()) {
                    $data = new Activity();
                    $data->name = $request->name;
                    $data->description = $request->description;
                    $data->subproject_fk_id = $request->subproject;
                    $data->type = $request->type;
                    $data->status = $request->status;
                    $data->created_at = Carbon::now();
                    $data->create_by_id = Auth::user()->id;
                    $data->save();
                    $activity_fk_id = $data->id;
                    //$this->createForm($activity_fk_id, $request->worker, $request->subproject);
                    return response()->json(['success' => __('strings.created_user'), 'activity_fk_id' => $activity_fk_id]);
                }
                return response()->json(['error' => $validator->errors()->toArray()]);
                //return response()->json(['error' => $validator->errors()->all()]);
            }
        }
    }

    public function createForm($activity_fk_id, $user_fk_id, $subproject_fk_id)
    {
        $form = new Form();
        $form->activity_fk_id = $activity_fk_id;
        $form->user_fk_id = $user_fk_id;
        $form->subproject_fk_id = $subproject_fk_id;
        $form->type = 0;
        $form->created_at = Carbon::now();
        $form->save();
    }



    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $activity = Activity::find($id);
        $workers = Worker::query()->where("form_fk_id",$activity->form->id)->get();
        return view('view_activity', compact('activity','workers'));
    }

    public function edit($id)
    {
        $activity = Activity::find($id);
        $workers = Worker::query()->where("form_fk_id",$activity->form->id)->get();
        return view('edit_activity', compact('activity','workers'));
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
            $subactivity = SubActivities::query()->where('activity_fk_id', $id);
            if ($activity->type == 0) {
                if ($form->delete() && $activity->delete()) {
                    return response()->json(['success' => __('strings.successfully_delete_project')]);
                }
            } else {
                if ($subactivity->delete() && $activity->delete()) {
                    return response()->json(['success' => __('strings.successfully_delete_project')]);
                }
            }
            return response()->json(['error' => 'strings.field_delete_activity']);
        }
    }
}
