<?php

namespace App\Http\Controllers;

use App\Charts\DyalyFormChart;
use App\Charts\MonthlyUsersChart;
use App\Models\Activity;
use App\Models\Form;
use App\Models\Project;
use App\Models\Subproject;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //TODO:: MOOMEN S. ALDAHDOUH 12/6/2021
    public function index(MonthlyUsersChart $chart, DyalyFormChart $formChart)
    {
        if (Auth::user()) {
            $type = Auth::user()->type;
            switch ($type) {
                case 0:
                    //Users statistics
                    $users = User::query()->latest()->get();
                    $latestUsers = User::query()->latest()->limit(10)->get();
                    $latestProjects = Project::query()->latest()->limit(5)->get();
                    $admins = User::query()->where('type', 0)->get();
                    $managers = User::query()->where('type', 1)->get();
                    $workers = User::query()->where('type', 2)->get();
                    //Projects statistics
                    $projects = Project::query()->get();
                    $subprojects = Subproject::query()->get();
                    $activities = Activity::query()->get();
                    $forms = Form::query()->latest()->get();
                    $formss = Form::query()->orderBy('created_at', 'asc')->get();
                    $latestForms = Form::query()->latest()->limit(10)->get();

                    //$formname= DB::select('SELECT name FROM form');
                    //$formdate= DB::select('SELECT created_at FROM form');
                    $data = [
                        'chart' => $chart->build(count($admins), count($managers), count($workers)),
                        'formChart' => $formChart->build($formss),
                        'projects' => $projects,
                        'subprojects' => $subprojects,
                        'activities' => $activities,
                        'forms' => $forms,
                        'latestForms' => $latestForms,
                        'users' => $users,
                        'latestUsers' => $latestUsers,
                        'latestProjects' => $latestProjects
                    ];
                    return view('home', $data);
                case 1:
                    return redirect('/');
            }
        } else
            return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
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
