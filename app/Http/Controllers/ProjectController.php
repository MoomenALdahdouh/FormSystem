<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::latest()->paginate(4);
        $trash = Project::onlyTrashed()->latest()->paginate(3);
        $users = User::query()->where('type', 1)->get();
        $data['projects'] = $projects;
        $data['trash'] = $trash;
        $data['users'] = $users;
        return view('projects', $data);
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //dd($request);
        $validatedData = $request->validate([
            'name' => 'required|unique:projects|max:255',
            'manager' => 'required|unique:projects,manager_fk_id|max:11|exists:users,id'
        ], [
            'name.required' => 'Please Input Project Name!',
            'name.max' => 'Max Length 255Chars!',
            'manager_fk_id.required' => 'Please Select User Manager!'
        ]);

        /*$data = array();
        $data['name'] = $request->name;
        $data['user_fk_id'] = Auth::user()->id;
        $data['manager_fk_id'] = $request->manager;
        $data['created_at'] = Carbon::now();
        //dd($data);
        //Project::query()->create($request->all());
        DB::table('projects')->insert($data);*/
        $data = new Project();
        $data->name = $request->name;
        $data->user_fk_id = Auth::user()->id;
        $data->manager_fk_id = $request->manager;
        $data->created_at = Carbon::now();
        $data->save();
        $project_id = $data->id;
        $this->updateUser($request->manager, $project_id);
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
        /**Using ORM Method*/
        /*$categories = Category::find($id);*/
        /**Using Query builder*/
        $categories = DB::table('categories')->where('id', $id)->first();

        return view('admin.categories.edit', compact('categories'));
    }

    public function search($string)
    {
        return Project::where("name", "like", "%" . $string . "%")->get();
    }

    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        //TODO: If you need to reuse the same manager to other project after delete this project hes was manager before
        /*$managerId = $project->manager_fk_id;
        $this->updateUser($managerId,0);*/
        return Redirect::back()->with('successUpdate', 'Successfully Delete Project');
    }

    public function forcedestroy($id)
    {
        $project = Project::onlyTrashed()->find($id);
        $forceDelete = $project->forceDelete();
        $managerId = $project->manager_fk_id;
        $this->updateUser($managerId,0);
        return Redirect::back()->with('successUpdate', 'Successfully Soft Delete Project');
    }

    public function restore($id)
    {
        $restore = Project::withTrashed()->find($id)->restore();
        return Redirect::back()->with('successUpdate', 'Successfully Force Restore Project');
    }

    public function updateUser($id, $project_id)
    {
        $users = User::find($id);
        if ($users) {
            $users->project_fk_id = $project_id;
            $users->save();
        }
    }
}
