<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SFTestController extends Controller {

    public function lookup_frontend_modules(Request $request) {

        $session_controller = new SFSessionController();
        $element_controller = new SFElementController();

        $session = $session_controller -> login(env('SFAPI_USERNAME'), env('SFAPI_PASSWORD'));
        $result = $element_controller -> list_elements($session);

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

    public function lookup_specific_module(Request $request, $module) {

        $session_controller = new SFSessionController();
        $element_controller = new SFElementController();

        $session = $session_controller -> login(env('SFAPI_USERNAME'), env('SFAPI_PASSWORD'));
        $result = $element_controller -> describe_element($session, $module);

        return response($result, 200) -> header('Content-Type', 'text/json');

    }

}
