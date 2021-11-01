<?php

namespace App\Exceptions;

use App\Serializers\ErrorSerializer;
use App\Traits\ExceptionRenderable;
use App\Transformers\ErrorTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use ExceptionRenderable;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * The transformer class for the error.
     *
     * @var string
     */
    protected $transformer = ErrorTransformer::class;

    /**
     * The serializer class for the error.
     *
     * @var string
     */
    protected $serializer = ErrorSerializer::class;

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param Throwable $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  Request  $request
     * @param Throwable $e
     * @return Response|JsonResponse
     *
     * @throws Throwable
     */
    public function render($request, Throwable $e)
    {
        if ($this->checkIfJsonRenderable($e)) {
            return $this->renderJson($request, $e);
        }

        return parent::render($request, $e);
    }
}
