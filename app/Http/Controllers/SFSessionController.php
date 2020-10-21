<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class SFSessionController extends Controller {

    public function login($username, $password, $name) {

        $response = $this -> fetch_session($username, $password, $name);
        if ($response["success"] == true) {
            $session_name = $response["result"]["sessionName"];
            session([$name . '_SESSION' => $session_name]);
            return $session_name;
        }
        return false;

    }

    public function current() {

        return session('CLIENT_SESSION');

    }

    public function logout() {
        Auth::logout();
        $this -> destroy_session('CLIENT');
        return redirect(route('landing'));
    }

    private function fetch_session($username, $password, $name) {
        $token_controller = new SFTokenController();
        $host = env('SFAPI_HOST');
        $operation = 'login';
        $token = md5($token_controller -> get($username, $name));

        return Http ::asForm() -> post($host, [
            'operation' => $operation,
            'username' => $username,
            'accessKey' => $password,
            'token' => $token
        ]) -> json();
    }

    private function destroy_session($name) {
        $session_name = session($name . '_SESSION');
        if (!is_null($session_name)) {
            $host = env('SFAPI_HOST');
            $operation = 'logout';

            $response = Http ::asForm() -> post($host, [
                'operation' => $operation,
                'sessionName' => $session_name
            ]) -> json();

            session([$name . '_SESSION' => null]);

            return $response["success"];

        }
        return false;
    }

}
