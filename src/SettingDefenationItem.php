<?php

namespace LaravelEloquentSettings;

use LaravelEloquentSettings\Enums\SettingValueType;

class SettingDefenationItem
{
    protected string $name;
    protected SettingValueType $type;
    protected mixed $default;
    protected bool $insertOnDefault = true;
    protected bool $nullable = false;
    protected ?array $customValidationRules = null;

    private function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function name(string $name): self
    {
        return new self($name);
    }

    public function type(SettingValueType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function default(mixed $default): self
    {
        $this->default = $default;

        return $this;
    }

    public function nullable(): self
    {
        $this->nullable = true;

        return $this;
    }

    public function disableInsertOnDefault(): self
    {
        $this->insertOnDefault = false;

        return $this;
    }

    public function validationRules(array $rules): self
    {
        $this->customValidationRules = $rules;

        return $this;
    }

    public function toEntity(): SettingDefenationEntity
    {
        return new SettingDefenationEntity(
            $this->name,
            $this->type,
            $this->default,
            $this->insertOnDefault,
            $this->nullable,
            $this->customValidationRules
        );
    }
}
