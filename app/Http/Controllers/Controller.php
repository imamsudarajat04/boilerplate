<?php

namespace App\Http\Controllers;

use http\Exception\InvalidArgumentException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

abstract class Controller
{
    protected RedirectResponse $response;
    protected array $responseMessage;

    /**
     * @param string $key
     * @return string
     */
    public function getResponseMessage(string $key): string
    {
        return $this->responseMessage[$key];
    }

    /**
     * @param array $response
     * @param string|null $to
     * @return bool
     */
    protected function isError(array $response, string $to = null): bool
    {
        if (!$response["success"]) {
            $redirect = $to ? redirect()->to($to) : redirect()->back();
            $redirect = $redirect->with("failed", $response["message"])->withInput();
            $this->setErrorResponse($redirect);
            return true;
        }

        return false;
    }

    /**
     * @param RedirectResponse $response
     * @return void
     */
    protected function setErrorResponse(RedirectResponse $response): void
    {
        $this->response = $response;
    }

    /**
     * @return RedirectResponse
     */
    protected function getErrorResponse(): RedirectResponse
    {
        return $this->response;
    }

    /**
     * @param array $response
     * @param string|RedirectResponse $toOrRedirectResponse
     * @param RedirectResponse|null $redirectResponse
     * @param \Closure|null $callback
     * @return RedirectResponse
     */
    protected function redirect(
        array $response,
        string|RedirectResponse $toOrRedirectResponse,
        RedirectResponse $redirectResponse = null,
        \Closure $callback = null
    ): RedirectResponse
    {
        if ($toOrRedirectResponse instanceof RedirectResponse) {
            $to = null;
            $redirectResponse = $toOrRedirectResponse;
        } else {
            $to = $toOrRedirectResponse;
        }

        if ($this->isError($response, $to)) return $this->getErrorResponse();

        if (!$redirectResponse) {
            throw new InvalidArgumentException("Since toRedirectResponse is route for error response, redirectResponse became required");
        }

        if ($callback instanceof \Closure) {
            $callback();
        }

        return $redirectResponse;
    }

    protected function responseView(
        array $response,
        string|Response $toOrResponse,
        Response $responseView = null,
        \Closure $callback = null
    ): RedirectResponse|Response
    {
        if ($toOrResponse instanceof Response) {
            $to = null;
            $responseView = $toOrResponse;
        } else {
            $to = $toOrResponse;
        }

        if ($this->isError($response, $to)) return $this->getErrorResponse();

        if (!$responseView) {
            throw new InvalidArgumentException("Since toOrResponse is route error response, responseView became required");
        }

        if ($callback instanceof \Closure) {
            $callback();
        }

        return $responseView;
    }
}
