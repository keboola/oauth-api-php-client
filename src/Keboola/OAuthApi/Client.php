<?php
namespace Keboola\OAuthApi;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class Client
{

    /**
     * @var string
     */
    protected $apiUrl = "https://syrup.keboola.com/oauth";

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $userAgent = "Keboola OAuth API PHP Client";

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;


    /**
     * Clients accept an array of constructor parameters.
     *
     * Here's an example of creating a client using an URI template for the
     * client's base_url and an array of default request options to apply
     * to each request:
     *
     *     $client = new Client([
     *         'url' => 'https://syrup.keboola.com/oauth'
     *         'token' => 'your_sapi_token',
     *     ]);
     *
     * @param array $config Client configuration settings
     *     - token: (required) Storage API token
     *     - url: (optional) OAuth API URL
     *     - userAgent: custom user agent
     */
    public function __construct($config)
    {
        if (isset($config['url'])) {
            $this->setApiUrl($config['url']);
        }
        if (isset($config['userAgent'])) {
            $this->setUserAgent($this->getUserAgent() . ' ' . $config['userAgent']);
        }
        if (!isset($config['token'])) {
            throw new \InvalidArgumentException('token must be set');
        }
        $this->setToken($config['token']);
        $this->initClient();
    }

    private function initClient()
    {
        $this->setClient(new \GuzzleHttp\Client([
            'base_uri' => $this->apiUrl
        ]));
    }

    /**
     * @return mixed|string
     * @throws ClientException
     * @throws MaintenanceException
     */
    public function getApis()
    {
        return $this->request('GET', $this->getApiUrl() . "/manage");
    }

    /**
     * @param $api
     * @param $id
     * @return mixed|string
     * @throws ClientException
     * @throws MaintenanceException
     */
    public function getCredentials($api, $id)
    {
        return $this->request('GET', $this->getApiUrl() . "/credentials/{$api}/{$id}");
    }

    /**
     * @param $method
     * @param $url
     * @param array $options
     * @return mixed|string
     * @throws ClientException
     * @throws MaintenanceException
     */
    protected function request($method, $url, $options = array())
    {
        $requestOptions = array_merge($options, [
            'headers' => [
                'X-StorageApi-Token' => $this->getToken(),
                'Accept-Encoding' => 'gzip',
                'User-Agent' => $this->getUserAgent(),
            ]
        ]);
        try {
            /**
             * @var ResponseInterface $response
             */
            $response = $this->client->request($method, $url, $requestOptions);
        } catch (RequestException $e) {
            $response = $e->getResponse();
            $body = $response ? json_decode((string) $response->getBody(), true) : array();
            if ($response && $response->getStatusCode() == 503) {
                throw new MaintenanceException(isset($body["reason"]) ? $body['reason'] : 'Maintenance', $response && $response->hasHeader('Retry-After') ? (string) $response->getHeader('Retry-After')[0] : null, $body);
            }
            throw new ClientException(
                isset($body['error']) ? $body['error'] : $e->getMessage(),
                $response ? $response->getStatusCode() : $e->getCode(),
                $e,
                isset($body['code']) ? $body['code'] : "",
                $body
            );
        }

        if ($response->hasHeader('Content-Type') && $response->getHeader('Content-Type')[0] == 'application/json') {
            return json_decode((string) $response->getBody(), true);
        }
        return (string) $response->getBody();
    }


    /**
     * @return string
     */
    protected function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
     * @param string $apiUrl
     * @return $this
     */
    protected function setApiUrl($apiUrl)
    {
        $this->apiUrl = $apiUrl;

        return $this;
    }

    /**
     * @return string
     */
    protected function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     * @return $this
     */
    protected function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    protected function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     * @return $this
     */
    protected function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return \GuzzleHttp\Client
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @param \GuzzleHttp\Client $client
     * @return $this
     */
    protected function setClient($client)
    {
        $this->client = $client;

        return $this;
    }
}
