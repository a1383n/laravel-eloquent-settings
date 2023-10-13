<?php

namespace LaravelEloquentSettings\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use LaravelEloquentSettings\EloquentSettings;
use LaravelEloquentSettings\Models\EloquentSetting;
use LaravelEloquentSettings\SettingDefinition;
use LaravelEloquentSettings\SettingDefinitionEntity;
use LaravelEloquentSettings\SettingHandler;
use LaravelEloquentSettings\SettingResolver;
use LaravelEloquentSettings\SettingSetter;

/**
 * Trait HasSettings
 *
 * This trait is designed to be used in Eloquent models that require dynamic settings management.
 *
 * @mixin Model
 */
trait HasSettings
{
    /**
     * Returns the morphMany relationship for settings associated with the model.
     *
     * @return MorphMany
     */
    public function settings(): MorphMany
    {
        return $this->morphMany(EloquentSetting::class, 'model');
    }

    /**
     * Gets the setting definition instance for the model.
     *
     * @return SettingDefinition
     */
    protected function getSettingDefinition(): SettingDefinition
    {
        if ($this->settingDefinition === null) {
            $this->settingDefinition = new SettingDefinition();

            $this->defineSettings($this->settingDefinition);
        }

        return $this->settingDefinition;
    }

    /**
     * Gets the setting handler instance for the model.
     *
     * @return SettingHandler
     */
    private function getHandler(): SettingHandler
    {
        return $this->settingHandler ?? EloquentSettings::getHandler($this);
    }

    /**
     * Gets the setting definition entity by name.
     *
     * @param string $name The name of the setting.
     *
     * @return SettingDefinitionEntity
     *
     * @throws \InvalidArgumentException When the setting is not defined for this model.
     */
    public function getSettingDefinitionByName(string $name): SettingDefinitionEntity
    {
        return isset($this->getSettingDefinition()->getDefinitions()[$name])
            ? $this->getSettingDefinition()->getDefinitions()[$name]->toEntity()
            : throw new \InvalidArgumentException(sprintf('(%s) setting not defined for this model', $name));
    }

    /**
     * Gets the value of a setting by name.
     *
     * @param string $name The name of the setting.
     *
     * @return mixed
     */
    public function getSettingValueByName(string $name): mixed
    {
        return (new SettingResolver($this->getHandler()))($this->getSettingDefinitionByName($name));
    }

    /**
     * Sets the value of a setting by name.
     *
     * @param string $name The name of the setting.
     * @param mixed $value The value to set.
     *
     * @return void
     */
    public function setSettingValueByName(string $name, mixed $value = null): void
    {
        (new SettingSetter($this->getHandler()))($this->getSettingDefinitionByName($name), $value);
    }
}
