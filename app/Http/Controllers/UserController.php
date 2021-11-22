<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $users = User::latest()->get();
        if ($request->ajax()) {
            return DataTables::of($users)
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
                            $type = '<p class="paragraph-worker shadow">&nbsp; Worker &nbsp;</p>';
                    }
                    /*return match ($users->type) {
                        1 => '<p class="paragraph-manager shadow">Manager</p>',
                        2 => '<p class="paragraph-worker shadow">Worker</p>',
                        default => '<p class="paragraph-admin shadow">&nbsp;Admin&nbsp;</p>',
                    };*/
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
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['type'], ['status'])
                ->escapeColumns(['action' => 'action'])
                ->make(true);
        }
        return view('users', compact('users'));
    }

    public function admin(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->where('type', 0)->get();
            return DataTables::of($users)->addColumn('action', function ($users) {
                $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        return view('admins');
    }

    //'.url("users/edit/1").'
    public function managers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->where('type', 1)->get();
            return DataTables::of($users)->addColumn('action', function ($users) {
                $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        return view('managers');
    }

    public function workers(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->where('type', 2)->get();
            return DataTables::of($users)->addColumn('action', function ($users) {
                $button = '<button data-id="' . $users->id . '" id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button data-id="' . $users->id . '" data-type="' . $users->type . '" id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        return view('workers');
    }

    public function create()
    {
        //
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
        //
    }

    public function destroy($id)
    {
        //
    }

}
