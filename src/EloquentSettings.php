<?php

namespace LaravelEloquentSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static getHandler(Model $model)
 */
class EloquentSettings extends Facade
{
    /**
     * @inheritDoc
     */
    protected static function getFacadeAccessor(): string
    {
        return 'eloquent_settings';
    }
}