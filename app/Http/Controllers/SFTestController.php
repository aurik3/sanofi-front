<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * A controller that allows for easy test-data fetching and verification.
 * Class SFTestController
 * @package App\Http\Controllers
 */
class SFTestController extends Controller {

    /**
     * Finds all the modules fetchable by Sanofi's API.
     * @param Request $request
     * @return mixed
     */
    public function lookup_frontend_modules(Request $request) {

        $session_controller = new SFSessionController();
        $element_controller = new SFElementController();

        $session = $session_controller -> login(env('SFAPI_USERNAME'), env('SFAPI_PASSWORD'), 'SFAPI');
        $result = $element_controller -> list_elements($session);

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

    /**
     * Finds the supplied module's information in Sanofi's API.
     * @param Request $request
     * @param $module
     * @return mixed
     */
    public function lookup_specific_module(Request $request, $module) {

        $session_controller = new SFSessionController();
        $element_controller = new SFElementController();

        $session = $session_controller -> login(env('SFAPI_USERNAME'), env('SFAPI_PASSWORD'), 'SFAPI');
        $result = $element_controller -> describe_element($session, $module);

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

    /**
     * Creates a Microlearning component map for visualization purposes with the supplied values.
     * @param Request $request
     * @return mixed
     */
    public function build_component_map(Request $request) {

        $label = $request -> get('label');
        $fields = $request -> get('fields');

        return view('microlearning.sub-test') -> with(['label' => $label, 'fields' => $fields]);

    }

    /**
     * Displays currently allocated events for the currently authenticated user.
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function view_events(Request $request) {

        $session_controller = new SFSessionController();
        $query_controller = new SFQueryController();

        $uid = $session_controller -> current_Id();
        $today = Carbon::now();
        $next_week = $today -> addWeek();

        $result = $query_controller -> stateful_basic('SELECT * FROM Events WHERE assigned_user_id = \''.$uid.'\' AND date_start >= \''.$today -> format('Y-m-d').'\' AND date_start <= \''.$next_week -> format('Y-m-d').'\' LIMIT 3;');

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

    /**
     * Displays currently stored statistics for the currently authenticated user.
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function view_stats(Request $request) {

        $session_controller = new SFSessionController();
        $query_controller = new SFQueryController();

        $uid = $session_controller -> current_Id();

        $planned = $query_controller -> stateful_basic('SELECT COUNT(*) FROM Events WHERE assigned_user_id = \''.$uid.'\' AND eventstatus = \''.'Planned'.'\';')[0] -> count;
        $authorized = $query_controller -> stateful_basic('SELECT COUNT(*) FROM Events WHERE assigned_user_id = \''.$uid.'\' AND eventstatus = \''.'Autorizada'.'\';')[0] -> count;

        $amounts = [$planned, $authorized];

        return response(json_encode($amounts), 200) -> header('Content-Type', 'text/json');

    }

    /**
     * Displays currently created users with their blowfish password hash.
     * @param Request $request
     * @return mixed
     * @throws \Exception
     */
    public function view_users(Request $request) {

        $query_controller = new SFQueryController();

        $result = $query_controller -> admin_basic('SELECT * FROM Users;');

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

}
