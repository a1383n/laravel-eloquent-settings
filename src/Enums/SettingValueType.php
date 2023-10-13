<?php

namespace LaravelEloquentSettings\Enums;

/**
 * Enum SettingValueType
 *
 * This enum represents the possible types for setting values.
 */
enum SettingValueType: string
{
    case STRING = 'string';
    case INTEGER = 'integer';
    case FLOAT = 'float';
    case BOOLEAN = 'boolean';
    case JSON = 'json';
    case ARRAY = 'array';
}
