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

### Uso Básico

El paquete permite trabajar con dos tipos de parámetros:

* Parámetros globales del sistema
* Parámetros asociados a modelos específicos

Todos los valores son almacenados tipados y recuperados automáticamente con su tipo nativo correspondiente.

### Parámetros Globales

Para administrar configuraciones globales utiliza la Facade:

```php
use Parameters;
use Zitro\Parameters\Enums\ParameterType;
```

#### Guardar Parámetros

```php
Parameters::set(
    'site_iva',
    22.5,
    ParameterType::FLOAT,
    'IVA general del comercio'
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

#### Obtener Parámetros

Los valores son retornados automáticamente con su tipo correspondiente.

```php
$iva = Parameters::get('site_iva');
// float(22.5)

$maintenance = Parameters::get('maintenance_mode');
// bool(true)

$countries = Parameters::get('allowed_countries');
// ['UY', 'AR', 'BR']
```

#### Valores por Defecto

```php
$logo = Parameters::get(
    'site_logo',
    'default-logo.png'
);
```

#### Eliminar Parámetros

```php
Parameters::forget('site_iva');
```

La caché asociada será invalidada automáticamente.

### Parámetros Asociados a Modelos

Puedes almacenar configuraciones específicas para cualquier entidad de tu sistema.

Por ejemplo:

* Usuarios
* Equipos
* Clientes
* Proyectos
* Organizaciones

#### Preparar un Modelo

Agregar el trait `HasParameters`:

```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Zitro\Parameters\Traits\HasParameters;

class Team extends Model
{
    use HasParameters;
}
```

#### Guardar Parámetros

```php
use Zitro\Parameters\Enums\ParameterType;

$team = Team::find($id);

$team->setParameter(
    'max_users',
    15,
    ParameterType::INT,
    'Límite de usuarios contratados'
);

$team->setParameter(
    'modules_enabled',
    ['crm', 'billing'],
    ParameterType::JSON
);
```

#### Obtener Parámetros

```php
$maxUsers = $team->getParameter('max_users');
// int(15)

$modules = $team->getParameter('modules_enabled');
// ['crm', 'billing']
```

#### Eliminar Parámetros

```php
$team->forgetParameter('max_users');
```

### Tipos Soportados

El paquete incluye soporte nativo para:

| Tipo    | Valor Devuelto |
| ------- | -------------- |
| STRING  | string         |
| INT     | int            |
| FLOAT   | float          |
| BOOLEAN | bool           |
| JSON    | array          |

La conversión se realiza automáticamente utilizando el tipo definido al almacenar el parámetro.

### Sistema de Caché

Para minimizar consultas repetidas a la base de datos, el paquete incorpora una capa de caché transparente.

Características:

* Caché independiente para parámetros globales
* Caché segmentada para parámetros polimórficos
* Invalidación automática al actualizar valores
* TTL configurable

Configuración:

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
