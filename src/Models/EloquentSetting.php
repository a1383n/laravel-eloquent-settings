<?php

namespace LaravelEloquentSettings\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEloquentSettings\Contracts\EloquentSettingModelInterface;

/**
 * Class EloquentSetting
 *
 * Eloquent model representing a setting.
 *
 * @package LaravelEloquentSettings\Models
 */
class EloquentSetting extends Model implements EloquentSettingModelInterface
{
    protected $table = 'eloquent_settings';

    protected $fillable = [
        'name',
        'value',
    ];

    protected $casts = [
        'value' => 'string',
    ];

    public function __construct(array $attributes = [])
    {
        // Set the table name from the configuration or use the default value
        $this->table = config('eloquent_settings.table_name', 'eloquent_settings');

        parent::__construct($attributes);
    }

    public function getName(): string
    {
        return $this->getAttribute('name');
    }

    public function getValue(): mixed
    {
        return $this->getAttribute('value');
    }
}
