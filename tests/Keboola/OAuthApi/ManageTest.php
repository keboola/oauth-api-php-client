<?php
namespace Keboola\OAuthApi;

use Test\OAuthApiTestCase;

class ManageTest extends OAuthApiTestCase
{

    public function testManageReturnsValue()
    {
        $this->assertNotEmpty($this->getClient()->getApis());
    }
}
