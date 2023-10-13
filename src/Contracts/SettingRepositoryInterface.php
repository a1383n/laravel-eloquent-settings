<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\Enums\SettingValueType;

interface SettingRepositoryInterface
{
    public function getSettingByName(string $name): ?EloquentSettingModelInterface;
    public function updateSettingByName(string $name, SettingValueType $type, mixed $value): bool|EloquentSettingModelInterface;
    public function createSettingByName(string $name, SettingValueType $type, mixed $value): EloquentSettingModelInterface;
}