<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait ApiResponseStructure
{
    /**
     * Return a success JSON response.
     *
     * @param array|string $returnData
     * @param string|null $message
     * @param int $responseCode
     * @return JsonResponse
     */
    protected function success($returnData, string $message = null, int $responseCode = 200)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $returnData
        ], $responseCode);
    }

    /**
     * Return an error JSON response.
     *
     * @param string|null $message
     * @param int $responseCode
     * @param null $returnData
     * @return JsonResponse
     */
    protected function error(string $message = null, int $responseCode, $returnData = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'data' => $returnData
        ], $responseCode);
    }

}
