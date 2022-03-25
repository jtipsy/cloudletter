<?php
/**
 * Created by PhpStorm.
 * User: jtipsy
 * Date: 2022/3/25
 * Time: 19:02
 */

namespace Jtipsy\Cloudletter\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

trait HttpClient
{
    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return string
     * @throws GuzzleException
     *
     */
    protected function httpGet(string $url, array $query = [], array $headers = [])
    {
        $options = [
            'headers' => $headers,
            'json'   => $query,
        ];

        return $this->httpRequest('GET', $url, $options);
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return string
     * @throws GuzzleException
     *
     */
    protected function httpPut(string $url, array $query = [], array $headers = [])
    {
        $options = [
            'headers' => $headers,
            'query'   => $query,
        ];

        return $this->httpRequest('PUT', $url, $options);
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $headers
     *
     * @return string
     * @throws GuzzleException
     *
     */
    protected function httpDelete(string $url, array $query = [], array $headers = [])
    {
        $options = [
            'headers' => $headers,
            'json'   => $query,
        ];

        return $this->httpRequest('DELETE', $url, $options);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     *
     * @return string
     * @throws GuzzleException
     *
     */
    protected function httpPost(string $url, array $params = [], array $headers = [])
    {
        $options = [
            'headers'     => $headers,
            'form_params' => $params,
        ];

        return $this->httpRequest('POST', $url, $options);
    }

    /**
     * @param string $url
     * @param array $params
     * @param array $headers
     *
     * @return string
     * @throws GuzzleException
     *
     */
    protected function httpPostJson(string $url, array $params = [], array $headers = [])
    {
        $options = [
            'headers' => $headers,
            'json'    => $params,
        ];

        return $this->httpRequest('POST', $url, $options);
    }

    /**
     * @param $method
     * @param $url
     * @param $options
     *
     * @return string
     * @throws GuzzleException
     *
     */
    protected function httpRequest($method, $url, $options)
    {
        $output = $this->httpClient()->request($method, $url, $options);
        $resp   = $output->getBody();
        return $resp;
    }

    /**
     * @return Client
     */
    protected function httpClient()
    {
        return new Client(['timeout' => 10, 'verify' => false]);
    }


}