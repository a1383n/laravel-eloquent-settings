<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefinitionEntity;

/**
 * Interface SettingSetterInterface
 *
 * This interface defines the contract for setting values for a given setting entity.
 */
interface SettingSetterInterface
{
    /**
     * Set the value for the provided setting entity.
     *
     * @param SettingDefinitionEntity $entity
     * @param mixed $value
     * @return void
     */
    public function __invoke(SettingDefinitionEntity $entity, mixed $value = null): void;
}
