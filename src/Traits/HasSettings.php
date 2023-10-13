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
 * @mixin Model
 */
trait HasSettings
{
    protected ?SettingDefinition $settingDefinition = null;
    private ?SettingHandler $settingHandler = null;

    public function settings(): MorphMany
    {
        return $this->morphMany(EloquentSetting::class, 'model');
    }

    /**
     * @return mixed
     */
    protected function getSettingDefinition(): SettingDefinition
    {
        if ($this->settingDefinition === null) {
            $this->settingDefinition = new SettingDefinition();

            $this->defineSettings($this->settingDefinition);
        }

        return $this->settingDefinition;
    }

    private function getHandler(): SettingHandler
    {
        return $this->settingHandler ?? EloquentSettings::getHandler($this);
    }

    public function getSettingDefinitionByName(string $name): SettingDefinitionEntity
    {
        return isset($this->getSettingDefinition()->getDefinitions()[$name])
            ? $this->getSettingDefinition()->getDefinitions()[$name]->toEntity()
            : throw new \Exception(sprintf('(%s) setting not defined for this model', $name));
    }

    public function getSettingValueByName(string $name): mixed
    {
        return (new SettingResolver($this->getHandler()))($this->getSettingDefinitionByName($name));
    }

    public function setSettingValueByName(string $name, mixed $value = null): void
    {
        (new SettingSetter($this->getHandler()))($this->getSettingDefinitionByName($name), $value);
    }
}
