<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Subproject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user_type = $request->get('user_type');

        $users = User::query()->latest()->get();
        if ($user_type < 3)
            $users = User::query()->where('type', $user_type);

        if ($request->ajax()) {
            return DataTables::of($users)
                ->addColumn('created_at', function ($projects) {
                    return '<p>' . \Carbon\Carbon::parse($projects->created_at)->diffForHumans() . '</p>';
                })
                ->addColumn('type', function ($users) {
                    $type = '<p class="paragraph-admin shadow">&nbsp;' . __('strings.admin') . '&nbsp;</p>';
                    switch ($users->type) {
                        case 0:
                            $type = '<p class="paragraph-admin shadow">&nbsp;&nbsp;' . __('strings.admin') . '&nbsp;&nbsp;</p>';
                            break;
                        case 1:
                            $type = '<p class="paragraph-manager shadow">' . __('strings.manager') . '</p>';
                            break;
                        case 2:
                            $type = '<p class="paragraph-worker shadow">&nbsp;' . __('strings.worker') . '&nbsp;</p>';
                    }
                    return $type;
                })
                ->addColumn('status', function ($users) {
                    $status = '';
                    if ($users->status == 0)
                        $status .= '<p class="paragraph-pended shadow">' . __('strings.pended') . '</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;' . __('strings.active') . '&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark rounded-2 p-1" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary rounded-2 p-1" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['created_at'], ['type'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        if (Auth::user()) {
            $type = Auth::user()->type;
            switch ($type) {
                case 0:
                    return view('users', compact('users'));
                case 1:
                    return redirect('/');
            }
        }
    }

    public function admin(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->where('type', 0)->get();
            return DataTables::of($users)
                ->addColumn('status', function ($users) {
                    $status = '';
                    if ($users->status == 0)
                        $status .= '<p class="paragraph-pended shadow">' . __('strings.pended') . '</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;' . __('strings.active') . '&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark rounded-2 p-1" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary rounded-2 p-1" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })->rawColumns(['status', 'action'])->make(true);
        }
        return view('admins');
    }

    //'.url("users/edit/1").'
    public function managers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->where('type', 1)->get();
            return DataTables::of($users)
                ->addColumn('status', function ($users) {
                    $status = '';
                    if ($users->status == 0)
                        $status .= '<p class="paragraph-pended shadow">' . __('strings.pended') . '</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;' . __('strings.active') . '&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark rounded-2 p-1" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary rounded-2 p-1" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })->rawColumns(['status', 'action'])->make(true);
        }
        return view('managers');
    }

    public function workers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->where('type', 2)->get();
            return DataTables::of($users)
                ->addColumn('status', function ($users) {
                    $status = '';
                    if ($users->status == 0)
                        $status .= '<p class="paragraph-pended shadow">' . __('strings.pended') . '</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;' . __('strings.active') . '&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger rounded-2 p-1" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark rounded-2 p-1" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary rounded-2 p-1" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })->rawColumns(['', 'action'])->make(true);
        }
        return view('workers');
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == "create") {
                $validator = Validator::make($request->all(), [
                    'name' => 'required:users|max:255',
                    'email' => 'required|unique:users',
                    'phone' => 'required|unique:users',
                ], [
                    'name.required' => __('strings.name_required'),
                    'email.required' => __('strings.email_required'),
                    'phone.required' => __('strings.phone_required')
                ]);


                if ($validator->passes()) {
                    $data = new User();
                    $data->name = $request->name;
                    $data->email = $request->email;
                    $data->phone = $request->phone;
                    $data->type = $request->type;
                    $data->status = $request->status;
                    $data->password = Hash::make("123456789");//(string)$this->randomPassword()
                    $data->created_at = Carbon::now();
                    $data->create_by_id = Auth::user()->id;
                    $data->save();
                    return response()->json(['success' => __('strings.successfully_create_user')]);
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
        $user = User::query()->find($id);
        $users = $user->users;
        $projects = '';
        $subprojects = '';
        $activities = '';
        switch ($user->type) {
            case 0:
                $projects = $user->projects;
                $subprojects = $user->subprojects;
                $activities = $user->activity;
                break;
            case 1:
                $projects = $user->manager;
                $userManageProject = $user->manager;
                $activities = $user->activity;
                $subprojects = Subproject::query()->where('project_fk_id', $userManageProject[0]['id'])->get();
                break;
            case 2:
                $activities = $user->activities;
                break;
        }
        return view('view_user', compact('user', 'projects', 'subprojects', 'activities', 'users'));
    }

    public function edit($id)
    {
        $user = User::query()->find($id);
        return view('edit_user', compact('user'));
    }

    public function update(Request $request, $id)
    {
        if ($request->ajax()) {
            if ($request->action == "update") {
                $update = User::query()->find($id);
                $update->name = $request->name;
                $update->nickname = $request->nickname;
                $update->phone = $request->phone;
                $update->status = $request->status;
                $update->save();
                if ($update)
                    return response()->json(['success' => __('strings.successfully_update_user')]);
                else
                    return response()->json(['error' => __('strings.field_update__user')]);
            }
        }
    }

    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $user = User::query()->find($id);
            switch ($user->type) {
                case 0:
                    if (count($user->projects) == 0) {
                        if ($user->delete()) {
                            return response()->json(['success' => __('strings.successfully_delete_admin')]);
                        } else
                            return response()->json(['error' => __('strings.field_delete_admin')]);
                    } else
                        return response()->json(['error' => __('strings.can_not_remove_admin')]);
                case 1:
                    if ($user->project_fk_id == 0) {
                        if ($user->delete()) {
                            return response()->json(['success' => __('strings.successfully_delete_manager')]);
                        } else
                            return response()->json(['error' => __('strings.field_delete_manager')]);
                    } else
                        return response()->json(['error' => __('strings.can_not_remove_manager')]);
                case 2:
                    if (count($user->activities) == 0) {
                        if ($user->delete()) {
                            return response()->json(['success' => __('strings.successfully_delete_worker')]);
                        } else
                            return response()->json(['error' => __('strings.field_delete_worker')]);
                    } else
                        return response()->json(['error' => __('strings.can_not_remove_worker')]);
            }
            return response()->json(['error' => __('strings.field_delete_user')]);
        }
    }

    function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, count($alphabet) - 1);
            $pass[$i] = $alphabet[$n];
        }
        return $pass;
    }

}
