<?php

namespace App\Http\Helpers;

class Helper
{
    public static function handleException(\Throwable $exception)
    {
        $statusCode = ($exception->getCode()> 500 || $exception->getCode() <100) ? 500 : (int)$exception->getCode();
        return response()->json(["errors" => ["message" => $exception->getMessage()]], $statusCode);
    }
}

