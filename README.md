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

<!-- Add a basic usage example here. -->

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
