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
            ->setTitle('Site Statistics')
            ->setSubtitle('Users')
            ->addData([$admins, $managers, $workers])
            ->setLabels(['Admins', 'Managers', 'Workers'])
            ->setFontColor("#FFF");
    }
}
