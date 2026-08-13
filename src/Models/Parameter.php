<?php

declare(strict_types=1);

namespace Zitro\Parameters\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Zitro\Parameters\Enums\ParameterType;

/**
 * @property ParameterType $type
 */
class Parameter extends Model
{
    protected $fillable = [
        'parameterable_type',
        'parameterable_id',
        'key',
        'value',
        'type',
        'description',
    ];

    /**
     * Los atributos que deben ser casteados a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => ParameterType::class,
    ];

    /**
     * Obtiene el nombre de la tabla asociada al modelo desde la configuración.
     *
     * @return string El nombre de la tabla de la base de datos.
     */
    public function getTable(): string
    {
        return config('parameters.table_name', 'parameters');
    }

    /**
     * @return MorphTo<Model, $this>
     */
    public function parameterable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Accesor para el atributo 'value'.
     *
     * Delega el casteo del string crudo directamente al método del Enum ParameterType.
     *
     * @param  mixed  $value  El valor crudo de la base de datos.
     * @return mixed El valor transformado según su tipo configurado.
     */
    public function getValueAttribute(mixed $value): mixed
    {
        return $this->type->cast($value);
    }
}
