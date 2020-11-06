<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use GuzzleHttp;
use App\JwtToApi;
use Firebase\JWT\JWT;

use App\Library\ManagerJWT;

class BaseApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function validateToken($token)
    {
        $ManagerJWT = new ManagerJWT();
        $response_estructure = $ManagerJWT->validateToken($token);
        return $response_estructure;
    }
}
