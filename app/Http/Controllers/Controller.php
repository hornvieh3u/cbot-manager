<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function response($data) {
        return [
            'status' => true,
            'data' => $data,
        ];
    }

    protected function error($code, $description) {
        return [
            'status' => false,
            'code' => $code,
            'error' => $description,
        ];
    }

    protected function dieError($code, $description) {
        $error = json_encode($this->error($code, $description));
        die($error);
    }

    protected function checkAuthentication() {
        if (!auth()->check()) {
            die(json_encode($this->error(-1, trans('main.please_login'))));
        }
    }
}
