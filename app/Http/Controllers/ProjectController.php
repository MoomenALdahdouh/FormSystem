<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        $projects = Project::query()->latest()->get();
        $trash = Project::onlyTrashed()->latest()->paginate(6);
        $users = User::query()->where('type', 1)->get();
        $data['projects'] = $projects;
        $data['trash'] = $trash;
        $data['users'] = $users;

        if ($request->ajax()) {
            return DataTables::of($projects)
                ->addColumn('user_fk_id', function ($projects) {
                    return '<strong>' . $projects->createBy->name . '</strong>';
                })
                ->addColumn('manager_fk_id', function ($projects) {
                    return '<strong>' . $projects->manageBy->name . '</strong>';
                })
                ->addColumn('created_at', function ($projects) {
                    return '<p>' . \Carbon\Carbon::parse($projects->created_at)->diffForHumans() . '</p>';
                })
                ->addColumn('status', function ($projects) {
                    $status = '';
                    if ($projects->status == 0)
                        $status .= '<p class="paragraph-pended shadow">Pended</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($projects) {
                    $button = '<button data-id="' . $projects->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $projects->id . '#edit-project' . '" data-type="' . $projects->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $projects->id . '" data-type="' . $projects->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['user_fk_id'],['manager_fk_id'],['created_at'],['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }

        $type = Auth::user()->type;
        switch ($type) {
            case 0:
                return view('projects', $data);
            case 1:
                return redirect('/');
        }
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
        if ($request->ajax()) {
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
        $project = Project::query()->find($id);
        return view('view_project', compact('project'));
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return view('edit_project', compact('project'));
    }

    public function update(Request $request, $id)
    {
        if ($request->action == "update") {
            $update = Project::find($id)->update([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'Successfully update Project']);
        }
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
