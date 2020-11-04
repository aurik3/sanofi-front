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

        $query_controller = new SFQueryController();
        $today = Carbon::now();
        $tomorrow = $today -> addDay();


        $result = $query_controller -> stateful_basic('SELECT * FROM Events WHERE date_start >= \''.$today -> format('Y-m-d').'\' AND date_start <= \''.$tomorrow -> format('Y-m-d').'\';');

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

}
