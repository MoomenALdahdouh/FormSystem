<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Subproject;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubprojectController extends Controller
{
    public function index()
    {
        $subprojects = Subproject::latest()->paginate(4);
        $trash = Subproject::onlyTrashed()->latest()->paginate(3);
        $projects = Project::all();
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
