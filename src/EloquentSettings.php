<?php

namespace LaravelEloquentSettings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * Class EloquentSettings
 *
 * Facade for accessing the EloquentSettings manager.
 *
 * @method static EloquentSettingManager getHandler(Model $model)
 *
 * @package LaravelEloquentSettings
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
