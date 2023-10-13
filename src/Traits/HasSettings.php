<?php

namespace LaravelEloquentSettings\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use LaravelEloquentSettings\EloquentSettings;
use LaravelEloquentSettings\Models\EloquentSetting;
use LaravelEloquentSettings\SettingDefenation;
use LaravelEloquentSettings\SettingDefenationEntity;
use LaravelEloquentSettings\SettingHandler;
use LaravelEloquentSettings\SettingResolver;
use LaravelEloquentSettings\SettingSetter;

/**
 * @mixin Model
 */
trait HasSettings
{
    protected ?SettingDefenation $settingDefenation = null;
    private ?SettingHandler $settingHandler = null;

    public function settings(): MorphMany
    {
        return $this->morphMany(EloquentSetting::class, 'model');
    }

    /**
     * @return mixed
     */
    protected function getSettingDefentaion(): SettingDefenation
    {
        if ($this->settingDefenation === null) {
            $this->settingDefenation = new SettingDefenation();

            $this->definedSettings($this->settingDefenation);
        }

        return $this->settingDefenation;
    }

    private function getHandler(): SettingHandler
    {
        return $this->settingHandler ?? EloquentSettings::getHandler($this);
    }

    public function getSettingDefenationByName(string $name): SettingDefenationEntity
    {
        return isset($this->getSettingDefentaion()->getDefenations()[$name])
            ? $this->getSettingDefentaion()->getDefenations()[$name]->toEntity()
            : throw new \Exception(sprintf('(%s) setting not defined for this model', $name));
    }

    public function getSettingValueByName(string $name): mixed
    {
        return (new SettingResolver($this->getHandler()))($this->getSettingDefenationByName($name));
    }

    public function setSettingValueByName(string $name, mixed $value): void
    {
        (new SettingSetter($this->getHandler()))($this->getSettingDefenationByName($name), $value);
    }
}
