<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\AreaChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use function Sodium\add;

class DyalyFormChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build($forms): AreaChart
    {
        $formdate = array();
        $formname = array();
        foreach ($forms as $form) {
            $date = date_create($form->created_at);
            array_push($formdate, date_format($date, "d"));
            array_push($formname, $form->name);
        }

        return $this->chart->areaChart()
            ->setTitle(__('strings.interviews_this_month'))
            ->addData(__('strings.day_in_the_month'), $formdate)
            //->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis($formname);
    }
}
