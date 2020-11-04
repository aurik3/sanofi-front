<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SFQueryController extends Controller {

    public function stateful_basic($query) {

        $session_controller = new SFSessionController();

        $host = env('SFAPI_HOST');
        $operation = "query";
        $session_name = $session_controller -> current();

        return Http::get($host, [
           'operation' => $operation,
           'sessionName' => $session_name,
            'query' => $query
        ]) -> json();

    }

}
