<?php

declare(strict_types=1);

namespace App\Charts;

use App\Http\Controllers\SFQueryController;
use App\Http\Controllers\SFSessionController;
use Carbon\Carbon;
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
     *
     * Uses the basic stateful querying engine to fetch the relevant information.
     */
    public function handler(Request $request): Chartisan {

        $session_controller = new SFSessionController();
        $query_controller = new SFQueryController();

        $start_date = Carbon::now() -> format('Y-m-d');
        $end_date = Carbon::now() -> endOfWeek() -> format('Y-m-d');

        $uid = $session_controller -> current_Id();

        $planned = $query_controller -> stateful_basic('SELECT COUNT(*) FROM Events WHERE assigned_user_id = \''.$uid.'\' AND eventstatus = \''.'Planned'.'\' AND date_start >= \''.$start_date.'\' AND date_start <= \''.$end_date.'\';')[0] -> count;
        $authorized = $query_controller -> stateful_basic('SELECT COUNT(*) FROM Events WHERE assigned_user_id = \''.$uid.'\' AND eventstatus = \''.'Autorizada'.'\' AND date_start >= \''.$start_date.'\' AND date_start <= \''.$end_date.'\';')[0] -> count;

        return Chartisan::build()
            ->labels(['Planeadas', 'Autorizadas',])
            ->dataset('Indicador', [$planned, $authorized]);
    }
}
