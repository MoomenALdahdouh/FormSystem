<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Worker;
use Illuminate\Http\Request;

class WorkerController extends Controller
{
    public function index()
    {

    }

    public function forms($id)
    {
        $worker = Worker::query()->where("worker_fk_id", $id)->get();
        $forms = [];
        foreach ($worker as $item) {
            if ($item->form[0]->type == 0) {
                //dd($item->form[0]->activity_fk_id);
                $activity = Activity::query()->where("id", $item->form[0]->activity_fk_id)->get()->first();
                $item->form[0]->name = $activity->name;
            }
            array_push($forms, $item->form[0]);
        }
        return ['results' => $forms];
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
