<?php

declare(strict_types=1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

class VisitsChart extends BaseChart
{

    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisans
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {
        return Chartisan::build()
            ->labels(['Realizadas', 'Agendadas',])
            ->dataset('Sample', [82, 18]);
    }
}
