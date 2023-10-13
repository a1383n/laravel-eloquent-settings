<?php

namespace LaravelEloquentSettings;

use LaravelEloquentSettings\Enums\SettingValueType;

/**
 * Class SettingDefinitionEntity
 *
 * Represents a single setting definition entity.
 *
 * @package LaravelEloquentSettings
 */
class SettingDefinitionEntity
{
    /**
     * SettingDefinitionEntity constructor.
     *
     * @param string $name
     * @param SettingValueType $type
     * @param mixed $default
     * @param bool $insertOnDefault
     * @param bool $nullable
     * @param array|null $customValidationRules
     */
    public function __construct(
        public readonly string           $name,
        public readonly SettingValueType $type,
        public readonly mixed            $default,
        public readonly bool             $insertOnDefault = true,
        public readonly bool             $nullable = false,
        public readonly ?array           $customValidationRules = null
    ) {
        //
    }
}
