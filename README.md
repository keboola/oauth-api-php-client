# Keboola OAuth API PHP Client
[![Latest Stable Version](https://poser.pugx.org/keboola/oauth-api-php-client/v/stable.svg)](https://packagist.org/packages/keboola/oauth-api-php-client)
[![Code Climate](https://codeclimate.com/github/keboola/oauth-api-php-client/badges/gpa.svg)](https://codeclimate.com/github/keboola/oauth-api-php-client)
[![Test Coverage](https://codeclimate.com/github/keboola/oauth-api-php-client/badges/coverage.svg)](https://codeclimate.com/github/keboola/oauth-api-php-client/coverage)
[![Build Status](https://travis-ci.org/keboola/oauth-api-php-client.svg?branch=master)](https://travis-ci.org/keboola/oauth-api-php-client)

Simple PHP wrapper library for [Keboola OAuth API](http://docs.oauth9.apiary.io/)

## Installation

Library is available as composer package.
To start using composer in your project follow these steps:

**Install composer**
  
```bash
curl -s http://getcomposer.org/installer | php
mv ./composer.phar ~/bin/composer # or /usr/local/bin/composer
```

**Create composer.json file in your project root folder:**
```json
{
    "require": {
        "php" : ">=5.6.0",
        "keboola/oauth-api-php-client": "~0.0.1"
    }
}
```

**Install package:**

```bash
composer install
```

**Add autoloader in your bootstrap script:**

```php
require 'vendor/autoload.php';
```

Read more in [Composer documentation](http://getcomposer.org/doc/01-basic-usage.md)

## Tests
Tests requires valid Storage API token and URL of OAuth API.
You can set these by copying file config.template.php into config.php and filling required constants int config.php file. Other way to provide parameters is to set environment variables:

    export=OAUTH_API_URL=https://syrup.keboola.com/oauth
    export=STORAGE_API_TOKEN=YOUR_TOKEN

Tests expects master token and performs all operations including bucket and table deletes on project storage associated to token. 

**Never run this tests on production project with real data, always create project for testing purposes!!!**

When the parameters are set you can run tests by **php vendor/bin/phpunit** command.

