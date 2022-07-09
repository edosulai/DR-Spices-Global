<?php

namespace App\Charts;

use App\Support\Livewire\ChartComponentData;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class StockChart extends Chart
{
    /**
     * Initializes the chart.
     *
     * @return void
     */
    public function __construct(ChartComponentData $data)
    {
        parent::__construct();

        $this->loader(false);

        $this->options([
            'maintainAspectRatio' => false,
            'legend' => [
                'display' => true,
            ],
            'scales' => [
                'xAxes' => [
                    'display' => false,
                ],
                'yAxes' => [
                    'display' => false,
                ],
            ],
            'tooltips' => [
                'backgroundColor' => "rgb(255, 255, 255, 0.8)",
                'bodyFontColor' => "#858796",
                'borderColor' => '#dddfeb',
                'borderWidth' => 1,
                'xPadding' => 15,
                'yPadding' => 15,
                'displayColors' => false,
                'caretPadding' => 10,
            ],
            'cutoutPercentage' => 50,
            'responsive' => true
        ]);

        $this->labels($data->labels());

        $this->dataset("Stock", "pie", $data->datasets()['spices'])->options([
            'backgroundColor' => $data->datasets()['colors'],
            'hoverBackgroundColor' => $data->datasets()['hover'],
            'hoverBorderColor' => "rgba(234, 236, 244, 1)",
        ]);
    }
}
