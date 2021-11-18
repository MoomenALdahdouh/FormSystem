<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use UxWeb\SweetAlert\SweetAlert;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::latest()->paginate(6);
        $trash = Project::onlyTrashed()->latest()->paginate(6);
        $users = User::query()->where('type', 1)->get();
        $data['projects'] = $projects;
        $data['trash'] = $trash;
        $data['users'] = $users;
        return view('projects', $data);
    }

    public function all(Request $request)
    {
        if ($request->ajax()) {
            $projects = Project::latest()->paginate(6);
            return view('pagination_projects', compact('projects'))->render();
        }
    }

    public function trash(Request $request)
    {
        if ($request->ajax()) {
            $trash = Project::onlyTrashed()->latest()->paginate(6);
            return view('pagination_trash_project', compact('trash'))->render();
        }
    }

    public function create(Request $request)
    {
        if ($request->ajax()){
            $data = new Project();
            $data->name = $request->name;
            $data->user_fk_id = Auth::user()->id;
            $data->manager_fk_id = $request->manager;
            $data->created_at = Carbon::now();
            $data->save();
            $project_id = $data->id;
            $this->updateUser($request->manager, $project_id);
            return response()->json(['success' => 'Successfully create new Project']);
        }
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
        $project =  Project::find($id);
        return view('view_project',compact('project'));
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
        //return Redirect::back()->with('successUpdate', 'Successfully Delete Project');
        return response()->json(['success' => 'Successfully Delete Project']);
    }

    public function forcedestroy($id)
    {
        $project = Project::onlyTrashed()->find($id);
        $project->forceDelete();
        $managerId = $project->manager_fk_id;
        $this->updateUser($managerId, 0);
        //return Redirect::back()->with('successUpdate', 'Successfully Force Delete Project');
        return response()->json(['success' => 'Successfully Force Delete Project']);
    }

    public function restore($id)
    {
        $restore = Project::withTrashed()->find($id)->restore();
        //return Redirect::back()->with('successUpdate', 'Successfully Restore Project');
        return response()->json(['success' => 'Successfully Restore Project']);
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
