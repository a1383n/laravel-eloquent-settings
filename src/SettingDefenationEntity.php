<?php

namespace LaravelEloquentSettings;

use LaravelEloquentSettings\Enums\SettingValueType;

class SettingDefenationEntity
{
    public function __construct(
        public readonly string           $name,
        public readonly SettingValueType $type,
        public readonly mixed            $default,
        public readonly bool             $insertOnDefault = true,
        public readonly bool             $nullable = false,
        public readonly ?array           $customValidationRules = null
    )
    {
        //
    }
}
