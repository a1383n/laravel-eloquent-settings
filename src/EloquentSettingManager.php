<?php

namespace LaravelEloquentSettings;

use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use LaravelEloquentSettings\Contracts\SettingHandlerInterface;
use LaravelEloquentSettings\Contracts\SettingRepositoryInterface;

/**
 * Class EloquentSettingManager
 *
 * Manager for handling Eloquent model settings.
 *
 * @package LaravelEloquentSettings
 */
class EloquentSettingManager
{
    /**
     * Get the setting handler for the given Eloquent model.
     *
     * @param Model $model
     *
     * @return SettingHandlerInterface
     *
     * @throws BindingResolutionException
     */
    public function getHandler(Model $model): SettingHandlerInterface
    {
        $container = Container::getInstance();

        return $container->make(
            SettingHandlerInterface::class,
            [
                'repository' => $container->make(SettingRepositoryInterface::class, ['morphManyRelation' => $model->{'settings'}()]),
            ]
        );
    }
}
