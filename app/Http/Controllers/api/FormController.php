<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\Interview;
use Illuminate\Http\Request;

class FormController extends Controller
{

    public function index($id)
    {
        $form = Form::query()->find($id);
        $interviews = $form->interviews;
        return $interviews;
    }

    public function show($id)
    {
        $form = Form::query()->find($id);
        $questions = $form->questions;
        return $questions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
