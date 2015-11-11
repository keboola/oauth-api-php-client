<?php
namespace Keboola\OAuthApi;

class ManageTest extends \OAuthApiTestCase
{

    public function testManageReturnsValue()
    {
        $this->assertNotEmpty($this->getClient()->getApis());
    }

}
