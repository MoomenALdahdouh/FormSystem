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
        /*$dfs = array();
        foreach ($formdate as $date) {
            array_push($dfs, $date);
        }
        $dfss = array();
        foreach ($formname as $name) {
            array_push($dfss, $name);
        }
        $array = json_decode(json_encode($formdate), true);
        /*foreach ($formdate as $value)
            $array[] = $value;
        print_r($array[0]['created_at']);
        $count = -1;*/
        $formdate = array();
        $formname = array();
        foreach ($forms as $form){
            $date=date_create($form->created_at);
            array_push($formdate,date_format($date,"d"));
            array_push($formname,$form->name);
        }

        return $this->chart->areaChart()
            ->setTitle('Interviews this month.')
            ->addData('Day in the month',$formdate)
            //->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis($formname);
    }
    /*public function objectToArray($o)
    {
        $a = array();
        foreach ($o as $k => $v) $a[$k] = (is_array($v) || is_object($v)) ? $this->objectToArray($v) : $v;
        return $a;
    }*/
}
