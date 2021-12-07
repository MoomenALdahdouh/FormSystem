<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\PieChart;

//TODO:: MOOMEN S. ALDAHDOUH 12/5/2021
class MonthlyUsersChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($admins, $managers, $workers): PieChart
    {
        return $this->chart->pieChart()
            ->setTitle( __("strings.site_statistics"))
            ->setSubtitle( __("strings.users"))
            ->addData([$admins, $managers, $workers])
            ->setLabels([__("strings.admin"), __("strings.manager"), __("strings.worker")])
            ->setFontColor("#FFF");
    }
}
