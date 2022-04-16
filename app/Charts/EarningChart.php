<?php

namespace App\Charts;

use App\Support\Livewire\ChartComponentData;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Carbon;

class EarningChart extends Chart
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
            'layout' => [
                'padding' => [
                    'left' => 10,
                    'right' => 20,
                    'top' => 0,
                    'bottom' => 0
                ]
            ],
            'scales' => [
                'xAxes' => [
                    [
                        'ticks' => [
                            'maxTicksLimit' => 15,
                        ],
                        'time' => [
                            'unit' => 'date'
                        ],
                        'gridLines' => [
                            'color' => "rgb(234, 236, 244)",
                            'zeroLineColor' => "rgb(234, 236, 244)",
                            'drawBorder' => false,
                            'borderDash' => [2],
                            'zeroLineBorderDash' => [2]
                        ],
                    ],
                ],
                'yAxes' => [
                    [
                        'ticks' => [
                            'maxTicksLimit' => 10,
                            'padding' => 10,
                        ],
                        'gridLines' => [
                            'color' => "rgb(234, 236, 244)",
                            'zeroLineColor' => "rgb(234, 236, 244)",
                            'drawBorder' => false,
                            'borderDash' => [2],
                            'zeroLineBorderDash' => [2]
                        ]
                    ],
                ],
            ],
            'legend' => [
                'display' => true,
            ],
            'tooltips' => [
                'backgroundColor' => "rgb(255, 255, 255, 0.8)",
                'bodyFontColor' => "#858796",
                'titleMarginBottom' => 10,
                'titleFontColor' => '#6e707e',
                'titleFontSize' => 14,
                'borderColor' => '#dddfeb',
                'borderWidth' => 1,
                'xPadding' => 15,
                'yPadding' => 15,
                'displayColors' => false,
                'intersect' => false,
                'mode' => 'index',
                'caretPadding' => 10
            ],
            'responsive' => true
        ]);

        $this->labels($data->labels());

        $this->dataset("Income " . currency()->getCurrency()['symbol'], "line", $data->datasets()['incomes'])->options([
            'backgroundColor'           => 'rgb(246, 194, 62, 0.4)',
            'borderColor'               => 'rgb(246, 194, 62, 1)',
            'pointHoverBackgroundColor' => 'rgb(246, 194, 62, 1)',
            'pointHoverBorderColor'     => 'rgb(246, 194, 62, 1)',
            'borderWidth'               => 1.5,
            'pointRadius'               => 1.5,
        ]);

        $this->dataset("Outcome " . currency()->getCurrency()['symbol'], "line", $data->datasets()['outcomes'])->options([
            'backgroundColor'           => 'rgb(127, 156, 245, 0.4)',
            'borderColor'               => 'rgb(78, 115, 223, 1)',
            'pointHoverBackgroundColor' => 'rgb(78, 115, 223, 1)',
            'pointHoverBorderColor'     => 'rgb(78, 115, 223, 1)',
            'borderWidth'               => 1.5,
            'pointRadius'               => 1.5,
        ]);
    }
}
