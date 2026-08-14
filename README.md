<div align="center">
    <h1>Parameters</h1>
</div>

<p align="center">
    <a href="https://packagist.org/packages/adolfoholzer/parameters"><img src="https://img.shields.io/packagist/v/adolfoholzer/parameters.svg?style=flat-square" alt="Packagist"></a>
    <a href="https://packagist.org/packages/adolfoholzer/parameters"><img src="https://img.shields.io/packagist/php-v/adolfoholzer/parameters.svg?style=flat-square" alt="PHP from Packagist"></a>
    <a href="https://packagist.org/packages/adolfoholzer/parameters"><img src="https://badge.laravel.cloud/badge/adolfoholzer/parameters?style=flat" alt="Laravel versions"></a>
    <a href="https://github.com/adolfoholzer/parameters/actions"><img alt="GitHub Workflow Status (main)" src="https://img.shields.io/github/actions/workflow/status/adolfoholzer/parameters/tests.yml?branch=main&label=Tests&style=flat-square"></a>
    <a href="https://packagist.org/packages/adolfoholzer/parameters"><img src="https://img.shields.io/packagist/dt/adolfoholzer/parameters.svg?style=flat-square" alt="Total Downloads"></a>
</p>

A dynamic parameter management package for Laravel that provides a simple and flexible way to define, store, and retrieve typed configuration values.

## Installation

You can install the package via Composer:

```bash
composer require adolfoholzer/parameters
```

You may publish all of the package's resources at once:

```bash
php artisan vendor:publish --tag="parameters"
```

Or, you may publish each resource individually:

### Publishing the Configuration File

```bash
php artisan vendor:publish --tag="parameters-config"
```

### Publishing and Running the Migrations

```bash
php artisan vendor:publish --tag="parameters-migrations"
php artisan migrate
```

## Usage

### Basic Usage

The package supports two types of parameters:

* Global system parameters
* Parameters associated with specific models

All values are stored with an explicit type and automatically cast back to their corresponding native type when retrieved.

### Global Parameters

Use the `Parameters` Facade to manage global configuration:

```php
use Parameters;
use Zitro\Parameters\Enums\ParameterType;
```

#### Storing Parameters

```php
Parameters::set(
    'site_iva',
    22.5,
    ParameterType::FLOAT,
    'General sales tax rate'
);

Parameters::set(
    'maintenance_mode',
    true,
    ParameterType::BOOLEAN
);

Parameters::set(
    'allowed_countries',
    ['UY', 'AR', 'BR'],
    ParameterType::JSON
);
```

#### Retrieving Parameters

Values are automatically returned with their corresponding native type.

```php
$iva = Parameters::get('site_iva');
// float(22.5)

$maintenance = Parameters::get('maintenance_mode');
// bool(true)

$countries = Parameters::get('allowed_countries');
// ['UY', 'AR', 'BR']
```

#### Default values

```php
$logo = Parameters::get(
    'site_logo',
    'default-logo.png'
);
```

#### Removing parameters

```php
Parameters::forget('site_iva');
```

The associated cache entry will be automatically invalidated.

### Model-Specific Parameters

You can store configuration values for any entity in your application.

For example:

* Users
* Teams
* Customers
* Projects
* Organizations

#### Preparing a Model

Add the `HasParameters` trait to your model:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Zitro\Parameters\Traits\HasParameters;

class Team extends Model
{
    use HasParameters;
}
```

#### Storing Parameters

```php
use Zitro\Parameters\Enums\ParameterType;

$team = Team::find($id);

$team->setParameter(
    'max_users',
    15,
    ParameterType::INT,
    'Maximum number of subscribed users'
);

$team->setParameter(
    'modules_enabled',
    ['crm', 'billing'],
    ParameterType::JSON
);
```

#### Retrieving Parameters

```php
$maxUsers = $team->getParameter('max_users');
// int(15)

$modules = $team->getParameter('modules_enabled');
// ['crm', 'billing']
```

#### Removing Parameters

```php
$team->forgetParameter('max_users');
```

### Supported Types

The package provides native support for:

| Type    | Returned Value |
| ------- | -------------- |
| STRING  | string         |
| INT     | int            |
| FLOAT   | float          |
| BOOLEAN | bool           |
| JSON    | array          |

Values are automatically cast using the type defined when the parameter is stored.

### Caching

To minimize repeated database queries, the package includes a transparent caching layer.

Features:

* Independent caching for global parameters
* Segmented caching for polymorphic parameters
* Automatic cache invalidation when values are updated
* Configurable TTL

Configuration:

```php
'use_cache' => true,
'cache_ttl' => 3600,
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Thank you for considering contributing to Parameters! Please review our [contributing guide](.github/CONTRIBUTING.md) to get started.

## Security Vulnerabilities

Please review [our security policy](.github/SECURITY.md) on how to report security vulnerabilities.

## Credits

- [Adolfo Holzer](https://github.com/adolfoholzer)
- [All Contributors](../../contributors)

## License

Parameters is open-sourced software licensed under the [MIT license](LICENSE.md).
