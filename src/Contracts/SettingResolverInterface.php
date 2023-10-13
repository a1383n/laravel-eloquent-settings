<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefenationEntity;

interface SettingResolverInterface
{
    public function __invoke(SettingDefenationEntity $entity): mixed;
}