<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefinition;

/**
 * Interface HasSettingsInterface
 *
 * This interface defines the contract for models that have settings.
 */
interface HasSettingsInterface
{
    /**
     * Define settings for the model.
     *
     * @param SettingDefinition $definition
     * @return void
     */
    public function defineSettings(SettingDefinition $definition): void;
}
