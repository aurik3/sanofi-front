<?php

namespace App\View\Components;

use App\Http\Controllers\SFQueryController;
use App\Http\Controllers\SFSessionController;
use Carbon\Carbon;
use Illuminate\View\Component;

class EventOverview extends Component
{

    public $elements;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {

        $session_controller = new SFSessionController();
        $query_controller = new SFQueryController();

        $uid = $session_controller -> current_Id();
        $today = Carbon::now();
        $next_week = $today -> addWeek();

        $events = $query_controller -> stateful_basic('SELECT * FROM Events WHERE assigned_user_id = \''.$uid.'\' AND date_start >= \''.$today -> format('Y-m-d').'\' AND date_start <= \''.$next_week -> format('Y-m-d').'\' ORDER BY date_start DESC LIMIT 3;');

        if (empty($events)) {

            $this -> elements = [
                [
                  'img' => asset('img/stk1.png'),
                  'title' => 'No tienes eventos pendientes para esta semana.'
                ]
            ];

        } else {

            $this -> elements = [
                [
                    'img' => asset('img/stk1.png'),
                    'title' => self::build_title($events[0])
                ],
                [
                    'img' => asset('img/stk2.png'),
                    'title' => self::build_title($events[1])
                ],
                [
                    'img' => asset('img/stk3.png'),
                    'title' => self::build_title($events[2])
                ]
            ];

        }

    }

    public static function build_title($event) {

        //Carbon::setlocale(config('app.locale'));

        $subject = $event -> subject;
        $x_date = explode('-', $event -> date_start);
        $x_day = $x_date[2];
        $x_month = $x_date[1];
        $x_year = $x_date[0];
        $month = Carbon::parse($x_year .'-'. $x_month .'-'. $x_day) -> translatedFormat('F');
        $date = $x_day . ' de ' . $month;

        return $subject . '<br/>' . $date;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.event-overview');
    }
}
