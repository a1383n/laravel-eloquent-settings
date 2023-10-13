<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefinitionEntity;

/**
 * Interface SettingHandlerInterface
 *
 * This interface defines the contract for handling settings.
 */
interface SettingHandlerInterface
{
    /**
     * Create a new setting.
     *
     * @param SettingDefinitionEntity $entity
     * @param mixed $value
     * @return void
     */
    public function createSetting(SettingDefinitionEntity $entity, mixed $value): void;

    /**
     * Update an existing setting.
     *
     * @param SettingDefinitionEntity $entity
     * @param mixed $value
     * @return void
     */
    public function updateSetting(SettingDefinitionEntity $entity, mixed $value): void;

    /**
     * Get the value of a setting.
     *
     * @param SettingDefinitionEntity $entity
     * @return EloquentSettingModelInterface
     */
    public function getSetting(SettingDefinitionEntity $entity): EloquentSettingModelInterface;
}
