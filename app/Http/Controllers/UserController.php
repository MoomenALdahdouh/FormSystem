<?php

namespace App\Http\Controllers;

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
                    $type = '<p class="paragraph-admin shadow">&nbsp;Admin&nbsp;</p>';
                    switch ($users->type) {
                        case 0:
                            $type = '<p class="paragraph-admin shadow">&nbsp;&nbsp;Admin&nbsp;&nbsp;</p>';
                            break;
                        case 1:
                            $type = '<p class="paragraph-manager shadow">Manager</p>';
                            break;
                        case 2:
                            $type = '<p class="paragraph-worker shadow">&nbsp;Worker&nbsp;</p>';
                    }
                    return $type;
                })
                ->addColumn('status', function ($users) {
                    $status = '';
                    if ($users->status == 0)
                        $status .= '<p class="paragraph-pended shadow">Pended</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['created_at'], ['type'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        $type = Auth::user()->type;
        switch ($type) {
            case 0:
                return view('users', compact('users'));
            case 1:
                return redirect('/');
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
                        $status .= '<p class="paragraph-pended shadow">Pended</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
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
                        $status .= '<p class="paragraph-pended shadow">Pended</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
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
                        $status .= '<p class="paragraph-pended shadow">Pended</p>';
                    else
                        $status .= '<p class="paragraph-active shadow">&nbsp;Active&nbsp;</p>';
                    return $status;
                })
                ->addColumn('action', function ($users) {
                    $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '#edit-user' . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
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
                    'name.required' => 'The name is required!',
                    'email.required' => 'The email is required!',
                    'phone.required' => 'The phone is required!'
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
        $user = User::find($id);
        return view('view_user', compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
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
                    return response()->json(['success' => 'Successfully update User']);
                else
                    return response()->json(['error' => 'Field to update this user!']);
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
                            return response()->json(['success' => 'Successfully Delete admin']);
                        } else
                            return response()->json(['error' => 'Field to delete this admin']);
                    }else
                        return response()->json(['error' => 'Can not remove this admin!, he manage some projects!']);
                case 1:
                    if ($user->project_fk_id == 0) {
                        if ($user->delete()) {
                            return response()->json(['success' => 'Successfully Delete manager']);
                        } else
                            return response()->json(['error' => 'Field to delete this manager']);
                    } else
                        return response()->json(['error' => 'Can not remove this manager, he manage some projects!']);
                case 2:
                    if (count($user->activities) == 0) {
                        if ($user->delete()) {
                            return response()->json(['success' => 'Successfully Delete worker']);
                        } else
                            return response()->json(['error' => 'Field to delete this worker']);
                    } else
                        return response()->json(['error' => 'Can not remove this worker, he manage some activities!']);
            }
            return response()->json(['error' => 'Field to delete the user']);
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
