<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

/**
 * A satetful cookie-based session manager to ensure consistency between Fortify's sessions and Sanofi's API sessions.
 * Class SFSessionController
 * @package App\Http\Controllers
 */
class SFSessionController extends Controller {

    /**
     * Perform a login action on Sanofi's API and generate a local cookie-based session.
     * @param $username
     * @param $password
     * @param $name
     * @return false|mixed
     */
    public function login($username, $password, $name) {

        $response = $this -> fetch_session($username, $password, $name);
        if ($response["success"] == true) {
            $session_name = $response["result"]["sessionName"];
            $user_id = $response["result"]["userId"];
            session([$name . '_SESSION' => $session_name]);
            session([$name . '_UID' => $user_id]);
            return $session_name;
        }
        return false;

    }

    /**
     * Fetch the current user-based session.
     * @return mixed
     */
    public function current() {

        return session('CLIENT_SESSION');

    }

    /**
     * Fetch the currently authenticated user's identifier.
     * @return mixed
     */
    public function current_Id() {

        return session('CLIENT_UID');

    }

    /**
     * Force a session destruction on both Fortify and Sanofi's API.
     * @return mixed
     */
    public function logout() {
        Auth::logout();
        $this -> destroy_session('CLIENT');
        return redirect(route('landing'));
    }

    /**
     * Sends a login request to Sanofi's API with the supplied credentials.
     * @param $username
     * @param $password
     * @param $name
     * @return mixed
     */
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

    /**
     * Sends a session destruction request to Sanofi's API with the supplied credentials.
     * @param $name
     * @return false|mixed
     */
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
