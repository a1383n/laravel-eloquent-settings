<?php

namespace LaravelEloquentSettings;

use LaravelEloquentSettings\Contracts\SettingSetterInterface;

class SettingSetter implements SettingSetterInterface
{
    public function __construct(protected readonly SettingHandler $handler)
    {
        //
    }

    public function __invoke(SettingDefenationEntity $entity, mixed $value = null): void
    {
        if ($value === null && ! $entity->nullable) {
            throw new \Exception(sprintf('(%s) setting is not nullable', $entity->name));
        }

        $this->handler->updateSetting($entity, $value ?? $entity->default);
    }
}
