<?php
/**
 *
 * User: Ondrej Hlavacek
 * Date: 11.11.15
 *
 */

namespace Test;

class OAuthApiTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Keboola\OAuthApi\Client
     */
    protected $client;

    public function setUp()
    {
        parent::setUp();
        $this->setClient(new \Keboola\OAuthApi\Client(array(
            'url' => OAUTH_API_URL,
            'token' => STORAGE_API_TOKEN
        )));
    }

    /**
     * @return \Keboola\OAuthApi\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param \Keboola\OAuthApi\Client $client
     * @return $this
     */
    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }
}
