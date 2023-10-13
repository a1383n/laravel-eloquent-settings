<?php

namespace LaravelEloquentSettings;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelEloquentSettings\Contracts\SettingResolverInterface;

class SettingResolver implements SettingResolverInterface
{
    public function __construct(protected readonly SettingHandler $handler)
    {
        //
    }

    public function __invoke(SettingDefenationEntity $entity): mixed
    {
        try {
            return $this->handler->getSetting($entity)
                ->mergeCasts(['value' => $entity->type->value])
                ->getValue();
        } catch (ModelNotFoundException) {
            app()->terminating(fn() => $this->handler->createSetting($entity, $entity->default));

            return $entity->default;
        }
    }
}
