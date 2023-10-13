<?php

namespace LaravelEloquentSettings\Models;

use Illuminate\Database\Eloquent\Model;
use LaravelEloquentSettings\Contracts\EloquentSettingModelInterface;

class EloquentSetting extends Model implements EloquentSettingModelInterface
{
    protected $table = 'eloquent_settings';

    protected $fillable = [
        'name',
        'value'
    ];

    protected $casts = [
        'value' => 'string'
    ];

    public function __construct(array $attributes = [])
    {
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
