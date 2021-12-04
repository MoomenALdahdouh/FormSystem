<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Subproject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SubprojectController extends Controller
{
    public function index(Request $request)
    {
        $subprojects = Subproject::query()->latest()->get();
        $trash = Subproject::onlyTrashed()->latest()->paginate(3);
        $projects = Project::all();
        if ($request->ajax()) {
            return DataTables::of($subprojects)
                ->addColumn('user_fk_id', function ($subprojects) {
                    return '<strong>' . $subprojects->user->name . '</strong>';
                })
                ->addColumn('project_fk_id', function ($subprojects) {
                    return '<strong>' . $subprojects->mainProject->name . '</strong>';
                })
                ->addColumn('created_at', function ($subprojects) {
                    return '<p>' . \Carbon\Carbon::parse($subprojects->created_at)->diffForHumans() . '</p>';
                })
                ->addColumn('status', function ($subprojects) {
                    $status = '';
                    if ($subprojects->status == 0)
                        $status .= '<p class="paragraph-pended shadow">Pended</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($subprojects) {
                    $button = '<button data-id="' . $subprojects->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $subprojects->id . '#edit-subproject' . '" data-type="' . $subprojects->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $subprojects->id . '" data-type="' . $subprojects->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['user_fk_id'], ['project_fk_id'], ['created_at'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        return view('subprojects', compact('subprojects', 'trash', 'projects'));
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == "create") {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|unique:subprojects|max:255',
                    'description' => 'required:subprojects',
                    'project' => 'required:subprojects',
                ], [
                    'name.required' => 'The name is required!',
                    'description.required' => 'The description is required!',
                    'project.required' => 'The project is required!',
                ]);
                if ($validator->passes()) {
                    $data = new Subproject();
                    $data->name = $request->name;
                    $data->description = $request->description;
                    $data->user_fk_id = Auth::user()->id;
                    $data->project_fk_id = $request->project;
                    $data->created_at = Carbon::now();
                    $data->updated_at = Carbon::now();
                    $data->status = $request->status;
                    $data->save();
                    return response()->json(['success' => 'Successfully create new project']);
                }
                return response()->json(['error' => $validator->errors()->toArray()]);
            }
        }
    }

    public function all(Request $request)
    {
        if ($request->ajax()) {
            $project = Project::query()->find($request->project_id);
            //$project = Subproject::query()->latest()->get();
            return view('pagination_subproject', compact('project'))->render();
        }
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:subprojects|max:255',
            'project' => 'required:subprojects,project_fk_id|max:255|exists:projects,id'
        ], [
            'name.required' => 'Please Input Subproject Name!',
            'name.max' => 'Max Length 255Chars!',
            'project_fk_id.required' => 'Please Select Project Name!'
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['project_fk_id'] = 1;
        $data['user_fk_id'] = Auth::user()->id;
        $data['project_fk_id'] = $request->project;
        $data['created_at'] = Carbon::now();
        DB::table('subprojects')->insert($data);
        return Redirect()->back()->with('success', 'Successfully Add Subproject');
    }

    public function show($id)
    {
        $subproject = Subproject::query()->find($id);
        return view('view_subproject', compact('subproject'));
    }

    public function edit($id)
    {
        $subproject = Subproject::query()->find($id);
        //$project = Project::query()->find($subproject->mainProject);
        return view('edit_subproject', compact('subproject'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $delete = Subproject::find($id)->delete();
        return Subproject::back()->with('successUpdate', 'Successfully Delete Subproject');
    }

    public function forcedestroy($id)
    {
        $forceDelete = Subproject::onlyTrashed()->find($id)->forceDelete();
        return Subproject::back()->with('successUpdate', 'Successfully Soft Delete Subproject');
    }

    public function restore($id)
    {
        $restore = Subproject::withTrashed()->find($id)->restore();
        return Subproject::back()->with('successUpdate', 'Successfully Force Restore Subproject');
    }
}
