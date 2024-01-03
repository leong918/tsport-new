<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use VVinners\Vapi\Api;

class Handler extends ExceptionHandler
{
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
        $this->renderable(function (GeneralException $err, $request) {
            $api = new Api();
            if ($request->ajax()) {
                return $api->response(null, $err->getMessage());
            }
            return $this->redirectBackWithError($err);
        });

        $this->renderable(function (TokenMismatchException $err) {
            return $this->redirectBackWithError($err);
        });
    }

    /**
     * Handle error thrown and redirect back with flash message
     *
     * @param GeneralException $exception
     *
     * @return void
     */
    protected function redirectBackWithError($exception)
    {
        return back()->with('error', $exception->getMessage())->withInput();
    }
}
