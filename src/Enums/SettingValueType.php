<?php

namespace LaravelEloquentSettings\Enums;

enum SettingValueType: string
{
    case STRING = 'string';
    case INTEGER = 'integer';
    case FLOAT = 'float';
    case BOOLEAN = 'boolean';
    case JSON = 'json';
    case ARRAY = 'array';
}