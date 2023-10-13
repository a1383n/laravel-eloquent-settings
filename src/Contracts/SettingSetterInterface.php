<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefenationEntity;

interface SettingSetterInterface
{
    public function __invoke(SettingDefenationEntity $entity, mixed $value = null): void;
}