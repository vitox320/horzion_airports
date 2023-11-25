<?php

namespace App\Exceptions;

use App\Traits\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Response;

    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function render($request, Throwable $e)
    {
        if ($e instanceof \DomainException) {
            return $this->apiResponse(['error' => 'Erro interno', 'message' => $e->getMessage()], 500);
        }
        if ($e instanceof RouteNotFoundException) {
            return $this->apiResponse(['error' => 'Erro interno', 'message' => $e->getMessage()], 500);
        }

        return $this->apiResponse(['error' => 'Erro interno'], 500);
    }

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
