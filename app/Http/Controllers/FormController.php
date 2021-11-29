<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        //
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            if ($request->action == "create") {
                $form = new Form();
                $form->activity_fk_id = $request->activity_fk_id;
                $form->user_fk_id = $request->worker_fk_id;
                $form->subproject_fk_id = $request->subproject_fk_id;
                $form->save();
                dd($form);
                return response()->json(['success' => 'Successfully create new User']);
            }
        }
    }

    public function apply($id)
    {
        $form = Form::query()->where('activity_fk_id',$id)->get();
        return view('apply_form', compact('form'));
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
        $form = Form::query()->where('activity_fk_id',$id)->get()->first();

        return view('edit_form', compact('form'));
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