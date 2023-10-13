<?php

namespace LaravelEloquentSettings;

/**
 * Class SettingDefinition
 *
 * Represents a collection of setting definitions.
 *
 * @package LaravelEloquentSettings
 */
class SettingDefinition
{
    /**
     * @var array
     */
    protected array $definitions = [];

    /**
     * Define a new setting.
     *
     * @param string $name
     * @return SettingDefinitionItem
     */
    public function define(string $name): SettingDefinitionItem
    {
        return $this->definitions[$name] = SettingDefinitionItem::name($name);
    }

    /**
     * Get all defined setting definitions.
     *
     * @return array
     */
    public function getDefinitions(): array
    {
        return $this->definitions;
    }
}
