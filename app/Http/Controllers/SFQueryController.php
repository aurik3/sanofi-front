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

        $raw_result = Http::get($host, [
           'operation' => $operation,
           'sessionName' => $session_name,
            'query' => $query
        ]) -> body();

        $result = json_decode($raw_result);

        if ($result -> success) {
            return $result -> result;
        } else {
            throw new \Exception('Internal error on API read: '.$result -> error -> code.' | '. $result -> error -> message, 400);
        }

    }

    public function admin_basic($query) {

        $session_controller = new SFSessionController();

        $host = env('SFAPI_HOST');
        $operation = "query";
        $session_name = $session_controller -> login(env('SFAPI_USERNAME'), env('SFAPI_PASSWORD'), 'SFAPI');

        $raw_result = Http::get($host, [
            'operation' => $operation,
            'sessionName' => $session_name,
            'query' => $query
        ]) -> body();

        $result = json_decode($raw_result);

        if ($result -> success) {
            return $result -> result;
        } else {
            throw new \Exception('Internal error on API read: '.$result -> error -> code.' | '. $result -> error -> message, 400);
        }

    }

}
