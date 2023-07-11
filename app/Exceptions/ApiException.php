<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;

class ApiException extends Exception
{

    public function render($request): JsonResponse
    {
        return response()->json([
            'error' => $this->getFile(),
            'message' => $this->getMessage(),
            'status' => $this->getCode(),
        ], $this->getCode());
    }


}
