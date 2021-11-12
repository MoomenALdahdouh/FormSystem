<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::latest()->paginate(3);
        $trash = Project::onlyTrashed()->latest()->paginate(3);
        return view('projects', compact('projects','trash'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:255',
        ], [
            'name.required' => 'Please Input Project Name!',
            'name.max' => 'Max Length 255Chars!',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['user_fk_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        DB::table('projects')->insert($data);
        return Redirect()->back()->with('success', 'Successfully Add Project');

    }

    public function show($id)
    {
        return $id ? Project::find($id) : Project::all();
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function search($string)
    {
        return Project::where("name", "like", "%" . $string . "%")->get();
    }

    public function destroy($id)
    {
        $delete = Project::find($id)->delete();
        return Redirect::back()->with('successUpdate','Successfully Delete Project');
    }

    public function forcedestroy($id)
    {
        $forceDelete = Project::onlyTrashed()->find($id)->forceDelete();
        return Redirect::back()->with('successUpdate', 'Successfully Soft Delete Project');
    }

    public function restore($id)
    {
        $restore = Project::withTrashed()->find($id)->restore();
        return Redirect::back()->with('successUpdate', 'Successfully Force Restore Project');
    }
}
