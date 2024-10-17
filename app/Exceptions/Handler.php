<?php

namespace App\Exceptions;

use App\Constants\StringConstant;
use App\Traits\AppResponseTrait;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Throwable;

class Handler extends ExceptionHandler
{
    use AppResponseTrait;

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

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            
        });
    }
    
    public function render($request, Throwable $exception)
    {

        // For all other exceptions, you can return a generic response
        return $this->errorRequest([
            'error' => $exception->getMessage(),
            'mainStatus' => 503,
        ]);
        
    }
}
