<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class SFTestController extends Controller {

    public function lookup_frontend_modules(Request $request) {

        $session_controller = new SFSessionController();
        $element_controller = new SFElementController();

        $session = $session_controller -> login(env('SFAPI_USERNAME'), env('SFAPI_PASSWORD'), 'SFAPI');
        $result = $element_controller -> list_elements($session);

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

    public function lookup_specific_module(Request $request, $module) {

        $session_controller = new SFSessionController();
        $element_controller = new SFElementController();

        $session = $session_controller -> login(env('SFAPI_USERNAME'), env('SFAPI_PASSWORD'), 'SFAPI');
        $result = $element_controller -> describe_element($session, $module);

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

    public function build_component_map(Request $request) {

        $label = $request -> get('label');
        $fields = $request -> get('fields');

        return view('microlearning.sub-test') -> with(['label' => $label, 'fields' => $fields]);

    }

    public function view_events(Request $request) {

        $session_controller = new SFSessionController();
        $query_controller = new SFQueryController();

        $uid = $session_controller -> current_Id();
        $today = Carbon::now();
        $next_week = $today -> addWeek();

        $result = $query_controller -> stateful_basic('SELECT * FROM Events WHERE assigned_user_id = \''.$uid.'\' AND date_start >= \''.$today -> format('Y-m-d').'\' AND date_start <= \''.$next_week -> format('Y-m-d').'\' LIMIT 3;');

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

    public function view_stats(Request $request) {

        $session_controller = new SFSessionController();
        $query_controller = new SFQueryController();

        $uid = $session_controller -> current_Id();

        $planned = $query_controller -> stateful_basic('SELECT COUNT(*) FROM Events WHERE assigned_user_id = \''.$uid.'\' AND eventstatus = \''.'Planned'.'\';')[0] -> count;
        $authorized = $query_controller -> stateful_basic('SELECT COUNT(*) FROM Events WHERE assigned_user_id = \''.$uid.'\' AND eventstatus = \''.'Autorizada'.'\';')[0] -> count;

        $amounts = [$planned, $authorized];

        return response(json_encode($amounts), 200) -> header('Content-Type', 'text/json');

    }

    public function view_users(Request $request) {

        $query_controller = new SFQueryController();

        $result = $query_controller -> admin_basic('SELECT * FROM Users;');

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

}
