<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefenation;

interface HasSettingsInterface
{
    public function definedSettings(SettingDefenation $defenation): void;
}
