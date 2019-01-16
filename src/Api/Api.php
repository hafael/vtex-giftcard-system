<?php
/**
 * Part of the VTEX GiftCardProvider package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    VTEX GiftCardSystem
 * @version    0.0.1
 * @author     VerdeIT
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017-2017, VerdeIT
 * @link       https://github.com/hafael/vtex-giftcard-provider
 */

namespace Hafael\VTEX\GiftCardSystem\Api;

use GuzzleHttp\Client;
use GuzzleHttp\Middleware;
use GuzzleHttp\HandlerStack;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\TransferException;
use Hafael\VTEX\GiftCardSystem\Utility;
use Hafael\VTEX\GiftCardSystem\ConfigInterface;
use Hafael\VTEX\GiftCardSystem\Exception\Handler;

abstract class Api implements ApiInterface
{
    /**
     * The Config repository instance.
     *
     * @var \Hafael\VTEX\GiftCardSystem\ConfigInterface
     */
    protected $config;

    /**
     * Constructor.
     *
     * @param  \Hafael\VTEX\GiftCardSystem\ConfigInterface  $client
     * @return void
     */
    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * {@inheritdoc}
     */
    public function baseUrl()
    {
        return $this->config->getBaseUrl();
    }


    /**
     * {@inheritdoc}
     */
    public function _get($url = null, $parameters = [], $headers = [])
    {

        return $this->execute('get', $url, $parameters, [], $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function _head($url = null, array $parameters = [])
    {
        return $this->execute('head', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _delete($url = null, array $parameters = [])
    {
        return $this->execute('delete', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _put($url = null, array $parameters = [])
    {
        return $this->execute('put', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function _patch($url = null, array $parameters = [], array $data = [])
    {
        return $this->execute('patch', $url, $parameters, $data);
    }

    /**
     * {@inheritdoc}
     */
    public function _post($url = null, array $parameters = [], array $data = [], array $headers = [])
    {
        return $this->execute('post', $url, $parameters, $data, $headers);
    }

    /**
     * {@inheritdoc}
     */
    public function _options($url = null, array $parameters = [])
    {
        return $this->execute('options', $url, $parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function execute($httpMethod, $url, array $parameters = [], array $data = [], array $headers = [])
    {
        try {
            
            $parameters = Utility::transformArrayIntoHttpQuery($parameters);

            $response = $this->getClient($headers)->{$httpMethod}($url, [ 'query' => $parameters ])->setBody(json_encode($data));

            return json_decode((string) $response->getBody(), true);
        } catch (ClientException $e) {
            new Handler($e);
        }
    }

    /**
     * Returns an Http client instance.
     *
     * @return \GuzzleHttp\Client
     */
    protected function getClient(array $headers = [])
    {
        return new Client([
            'base_uri' => $this->baseUrl(), 'handler' => $this->createHandler($headers)
        ]);
    }

    /**
     * Create the client handler.
     *
     * @return \GuzzleHttp\HandlerStack
     */
    protected function createHandler(array $headers = [])
    {
        $stack = HandlerStack::create();

        $stack->push(Middleware::mapRequest(function (RequestInterface $request) use ($headers) {

            $config = $this->config;
            
            $request = $request->withHeader('Accept', 'application/json');

            $request = $request->withHeader('Content-Type', 'application/json');

            $request = $request->withHeader('x-vtex-api-appKey', $config->getAppKey());

            $request = $request->withHeader('x-vtex-api-appToken', $config->getAppToken());

            foreach($headers as $key => $value) {
                $request = $request->withHeader($key, $value);
            }

            return $request;
        }));

        $stack->push(Middleware::retry(function ($retries, RequestInterface $request, ResponseInterface $response = null, TransferException $exception = null) {
            return $retries < 3 && ($exception instanceof ConnectException || ($response && $response->getStatusCode() >= 500));
        }, function ($retries) {
            return (int) pow(2, $retries) * 1000;
        }));

        return $stack;
    }
}