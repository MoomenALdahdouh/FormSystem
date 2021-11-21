<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $typeId = 0;
        /*if ($type == "admins")
            $typeId = 0;*/
        if ($request->ajax()) {
            $users = User::query()->where('type', $typeId)->get();
            return DataTables::of($users)->addColumn('action', function ($users) {
                $button = ' <button
                    class="delete btn-outline-danger sm:rounded-md" title="delete"></button>';
                return $button;
            })->rawColumns(['action'])->make(true);
        }
        return view('admins');
        //return view('admins', compact('users'));
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
        //
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
        //
    }

}
