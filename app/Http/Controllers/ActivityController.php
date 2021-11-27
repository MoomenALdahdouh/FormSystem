<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Subproject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ActivityController extends Controller
{

    public function index(Request $request)
    {
        $activities = Activity::query()->latest()->get();
        if ($request->ajax()) {
            return DataTables::of($activities)
                ->addColumn('worker', function ($activities) {
                    return '<strong>' . $activities->worker->name . '</strong>';
                })
                ->addColumn('subproject', function ($activities) {
                    return '<strong>' . $activities->subproject->name . '</strong>';
                })
                ->addColumn('type', function ($activities) {
                    $type = '<p class="paragraph-admin shadow">&nbsp;Admin&nbsp;</p>';
                    switch ($activities->type) {
                        case 0:
                            $type = '<p class="activity-type shadow">&nbsp;&nbsp;Form&nbsp;&nbsp;</p>';
                            break;
                        case 1:
                            $type = '<p class="paragraph-manager shadow">Manager</p>';
                            break;
                        case 2:
                            $type = '<p class="paragraph-worker shadow">&nbsp;Worker&nbsp;</p>';
                    }
                    return $type;
                })
                ->addColumn('status', function ($activities) {
                    $status = '';
                    if ($activities->status == 0)
                        $status .= '<p class="paragraph-pended shadow">Pended</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($activities) {
                    $button = '<button data-id="' . $activities->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $activities->id . '#edit-user' . '" data-type="' . $activities->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $activities->id . '" data-type="' . $activities->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['subproject'], ['worker'], ['type'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        $workers = User::query()->where('type', 2)->get();
        $subprojects = Subproject::query()->where('status', 1)->get();
        return view('activities', compact('activities', 'subprojects', 'workers'));
    }


    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == "create") {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:activities|max:255',
                    'description' => 'required',
                ], [
                    'name.required' => 'The name is required!',
                    'description.required' => 'The description is required!',
                ]);


                if ($validator->passes()) {
                    $data = new Activity();
                    $data->name = $request->name;
                    $data->description = $request->description;
                    $data->user_fk_id = $request->worker;
                    $data->subproject_fk_id = $request->subproject;
                    $data->type = $request->type;
                    $data->status = $request->status;
                    $data->created_at = Carbon::now();
                    $data->save();
                    return response()->json(['success' => 'Successfully create new User']);
                }
                return response()->json(['error' => $validator->errors()->toArray()]);
                //return response()->json(['error' => $validator->errors()->all()]);
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
        return view('view_activity', compact('activity'));
    }

    public function edit($id)
    {

        $activity = Activity::find($id);
        return view('edit_activity', compact('activity'));
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
