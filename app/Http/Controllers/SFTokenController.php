<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Symfony\Component\CssSelector\Exception\InternalErrorException;

/**
 * A controller for managing, storing and creating user tokens to comply with Sanofi's API.
 * Class SFTokenController
 * @package App\Http\Controllers
 */
class SFTokenController extends Controller {

    /**
     * Gets a particular User kind's token.
     * @param $username
     * @param $name
     * @return mixed
     */
    public function get($username, $name) {
        $current_token = session($name.'_TOKEN');
        if ($current_token && $this -> is_token_valid($name.'_TOKEN')) {
            return session($name.'_TOKEN')['token'];
        }
        return $this -> fetch_token($username, $name)['token'];
    }

    /**
     * Verifies if the supplied token var has expired and whether is valid or not.
     * @param $name
     * @return bool
     */
    private function is_token_valid($name) {
        $token = session($name.'_TOKEN');
        return !$token["expiration"] -> isPast();
    }

    /**
     * Requests a token from Sanofi's API with the supplied credentials.
     * @param $username
     * @param $name
     * @return array|InternalErrorException
     */
    private function fetch_token($username, $name) {
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
            session($name.'_TOKEN', $formattedToken);
            return $formattedToken;

        }

        return new InternalErrorException('Token fetch from 3rd party API failed.');

    }

}
