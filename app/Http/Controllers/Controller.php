<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * json output method
     *
     * @param $code
     * @param $msg
     * @param null $data
     * @param string $format
     * @return \Illuminate\Http\JsonResponse
     */
    protected function json_output($code, $msg, $data = NULL, $format = 'json')
    {
        if (is_null($data)) {
            return response()->json(['code' => $code, 'msg' => $msg]);
        }
        return response()->json(['code' => $code, 'data' => $data, 'msg' => $msg]);
    }
}
