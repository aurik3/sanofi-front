<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SFSessionController extends Controller {

    public function login($username, $password) {

        $response = $this -> fetch_session($username, $password);
        if ($response["success"] == true) {
            $session_name = $response["result"]["sessionName"];
            session('SFAPI_SESSION', $session_name);
            return $session_name;
        }
        return false;

    }

    public function logout() {
        return $this -> destroy_session();
    }

    private function fetch_session($username, $password) {
        $token_controller = new SFTokenController();
        $host = env('SFAPI_HOST');
        $operation = 'login';
        $token = md5($token_controller -> get($username));

        return Http ::asForm() -> post($host, [
            'operation' => $operation,
            'username' => $username,
            'accessKey' => $password,
            'token' => $token
        ]) -> json();
    }

    private function destroy_session() {
        $session_name = session('SFAPI_SESSION');
        if (!is_null($session_name)) {
            $host = env('SFAPI_HOST');
            $operation = 'logout';

            $response = Http ::asForm() -> post($host, [
                'operation' => $operation,
                'sessionName' => $session_name
            ]) -> json();

            return $response["success"];

        }
        return false;
    }

}
