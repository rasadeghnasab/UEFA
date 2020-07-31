<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class APICallFailed extends Exception
{
    /**
     * Render an exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->common([
            'message' => $this->getMessage(),
            'status' => Response::HTTP_FAILED_DEPENDENCY
        ]);
    }
}
