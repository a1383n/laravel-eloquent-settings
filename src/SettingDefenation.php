<?php

namespace LaravelEloquentSettings;

class SettingDefenation
{
    protected array $defenations = [];

    public function define(string $name): SettingDefenationItem
    {
        return $this->defenations[$name] = SettingDefenationItem::name($name);
    }

    /**
     * @return array
     */
    public function getDefenations(): array
    {
        return $this->defenations;
    }
}
