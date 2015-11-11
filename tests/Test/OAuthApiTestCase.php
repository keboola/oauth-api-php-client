<?php
/**
 *
 * User: Ondrej Hlavacek
 * Date: 11.11.15
 *
 */

class OAuthApiTestCase extends PHPUnit_Framework_TestCase
{
	/**
	 * @var \Keboola\OAuthApi\Client
	 */
	protected $client;

	public function setUp()
	{
        parent::setUp();
		$this->_client = new \Keboola\OAuthApi\Client(array(
			'url' => OAUTH_API_URL,
            'token' => STORAGE_API_TOKEN
		));
	}

}