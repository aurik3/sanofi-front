<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

class SFTokenController extends Controller {

    public function get($username) {
        $current_token = session('SFAPI_TOKEN');
        if ($current_token && $this -> is_token_valid()) {
            return session('SFAPI_TOKEN')['token'];
        }
        return $this -> fetch_token($username)['token'];
    }

    private function is_token_valid() {
        $token = session('SFAPI_TOKEN');
        return !$token["expiration"] -> isPast();
    }

    private function fetch_token($username) {
        $host = env('SFAPI_HOST');
        $operation = "getchallenge";

        $response = Http ::get($host, [
            'operation' => $operation,
            'username' => $username
        ]);

        if ($response -> ok()) {

            $response = $response -> json();
            $token = $response['result']['token'];
            $formattedToken = [
                "token" => $token,
                "creation" => Carbon ::now(),
                "expiration" => Carbon ::now() -> addMinutes(5)
            ];
            session('SFAPI_TOKEN', $formattedToken);
            return $formattedToken;

        }

        return new InternalErrorException('Token fetch from 3rd party API failed.');

    }

}
