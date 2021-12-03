<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Subproject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
                ->rawColumns(['user_fk_id'],['project_fk_id'],['created_at'],['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        return view('subprojects', compact('subprojects', 'trash','projects'));
    }

    public function create()
    {
        //
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
        return $id ? Subproject::find($id) : Subproject::all();
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
