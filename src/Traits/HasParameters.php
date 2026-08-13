<?php

declare(strict_types=1);

namespace Zitro\Parameters\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Zitro\Parameters\Enums\ParameterType;
use Zitro\Parameters\Facades\Parameters;
use Zitro\Parameters\Models\Parameter;

/**
 * Trait HasParameters
 *
 * Permite a cualquier modelo de Eloquent gestionar parámetros dinámicos
 * de forma polimórfica, integrándose automáticamente con el sistema de caché.
 */
trait HasParameters
{
    /**
     * Relación polimórfica nativa de muchos a muchos (MorphMany).
     *
     * Permite realizar carga previa (eager loading) desde la aplicación principal
     * utilizando estructuras como: $modelo->load('parameters') o Model::with('parameters').
     */
    public function parameters(): MorphMany
    {
        return $this->morphMany(Parameter::class, 'parameterable');
    }

    /**
     * Obtiene el valor de un parámetro específico delegando en el servicio con su caché.
     *
     * @param  string  $key  El identificador único del parámetro.
     * @param  mixed  $default  Valor de retorno por defecto si el parámetro no existe.
     * @return mixed El valor del parámetro casteado a su tipo nativo, o el valor por defecto.
     */
    public function getParameter(string $key, mixed $default = null): mixed
    {
        return Parameters::get($key, $default, $this);
    }

    /**
     * Guarda o actualiza un parámetro para este modelo y limpia su caché asociada.
     *
     * @param  string  $key  El identificador único del parámetro.
     * @param  mixed  $value  El valor a almacenar (acepta arrays para formato JSON).
     * @param  ParameterType|null  $type  El tipo de dato para el casteo.
     * @param  string|null  $description  Breve comentario descriptivo del parámetro.
     * @return Parameter La instancia del parámetro guardada.
     */
    public function setParameter(
        string $key,
        mixed $value,
        ?ParameterType $type = null,
        ?string $description = null,
    ): Parameter {
        return Parameters::set($key, $value, $type, $description, $this);
    }

    /**
     * Elimina un parámetro específico de este modelo y limpia su caché asociada.
     *
     * @param  string  $key  El identificador único del parámetro.
     * @return bool True si el parámetro se eliminó correctamente, false en caso contrario.
     */
    public function forgetParameter(string $key): bool
    {
        return Parameters::forget($key, $this);
    }
}
