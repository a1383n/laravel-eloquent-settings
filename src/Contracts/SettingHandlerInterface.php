<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefenationEntity;

interface SettingHandlerInterface
{
    public function createSetting(SettingDefenationEntity $entity, mixed $value): void;

    public function updateSetting(SettingDefenationEntity $entity, mixed $value): void;

    public function getSetting(SettingDefenationEntity $entity): EloquentSettingModelInterface;
}