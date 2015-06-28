<?php

/*
 * This file is part of NotifyMe.
 *
 * (c) Alt Three LTD <support@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NotifyMeHQ\NotifyMe;

trait HttpGatewayTrait
{
    /**
     * Commit a HTTP request.
     *
     * @param string   $method
     * @param string   $url
     * @param string[] $params
     * @param string[] $options
     *
     * @return mixed
     */
    abstract protected function commit($method = 'post', $url, array $params = [], array $options = []);

    /**
     * Map HTTP response to response object.
     *
     * @param bool  $success
     * @param array $response
     *
     * @return \NotifyMeHQ\Contracts\ResponseInterface
     */
    abstract protected function mapResponse($success, $response);


    /**
     * Get error response from server or fallback to general error.
     *
     * @param \GuzzleHttp\Message\Response $rawResponse
     *
     * @return array
     */
    protected function responseError($rawResponse)
    {
        return $rawResponse->json() ?: $this->jsonError($rawResponse);
    }

    /**
     * Get the default json response.
     *
     * @param \GuzzleHttp\Message\Response $rawResponse
     *
     * @return array
     */
    abstract protected function jsonError($rawResponse);

    /**
     * Get the gateway request url.
     *
     * @return string
     */
    abstract protected function getRequestUrl();

    /**
     * Build request url from string.
     *
     * @param string $endpoint
     *
     * @return string
     */
    protected function buildUrlFromString($endpoint)
    {
        return $this->getRequestUrl().'/'.$endpoint;
    }
}
