<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SFElementController extends Controller {

    public function list_elements($sessionName) {
        $host = env('SFAPI_HOST');
        $operation = "listtypes";

        return Http::get($host, [
            'operation' => $operation,
            'sessionName' => $sessionName
        ]) -> json();

    }

    public function describe_element($sessionName, $element) {
        $host = env('SFAPI_HOST');
        $operation = "describe";

        return Http::get($host, [
            'operation' => $operation,
            'sessionName' => $sessionName,
            'elementType' => $element
        ]) -> json();
    }

}
