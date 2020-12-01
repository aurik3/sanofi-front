<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/**
 * A simple Querying controller that allows for simple authenticated (Both admin and generic) querying to
 * Sanofi's database through the use of stored sessions.
 *
 * Class SFQueryController
 * @package App\Http\Controllers
 */

class SFQueryController extends Controller {

    /**
     * Executes the supplied query using the currently authenticated user's credentials in Sanofi's database.
     * @param $query
     * @return mixed
     * @throws \Exception
     */
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

    /**
     * Executes the supplied query using the application's admin credentials in Sanofi's database.
     * @param $query
     * @return mixed
     * @throws \Exception
     */
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
