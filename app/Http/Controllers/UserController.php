<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::latest()->get();
            return DataTables::of($users)->addColumn('action', function ($users) {
                $button = '<button id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        return view('users');
    }

    public function admin(Request $request)
    {
        if ($request->ajax()) {
            $users = User::query()->where('type', 0)->get();
            return DataTables::of($users)->addColumn('action', function ($users) {
                $button = '<button id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
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
                $button = '<button id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
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
                $button = '<button id="delete" class="delete btn-outline-danger sm:rounded-md" title="delete"><i class="bx bx-trash"></i></button>&nbsp;
                           <button id="edit" class="btn-outline-dark sm:rounded-md" title="settings"><i class="las la-cog"></i></button>&nbsp;
                           <button id="view" class="btn-outline-primary sm:rounded-md" title="view"><i class="las la-external-link-alt"></i></button>';
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
