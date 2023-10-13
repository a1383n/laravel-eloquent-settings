<?php

namespace LaravelEloquentSettings;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use LaravelEloquentSettings\Contracts\SettingHandlerInterface;
use LaravelEloquentSettings\Contracts\SettingRepositoryInterface;

class EloquentSettingManager
{
    public function getHandler(Model $model): SettingHandlerInterface
    {
        $container = Container::getInstance();

        return $container->make(
            SettingHandlerInterface::class,
            [
                'repository' => $container->make(SettingRepositoryInterface::class, ['morphManyRelation' => $model->settings()])
            ]
        );
    }
}