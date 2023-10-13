<?php

namespace LaravelEloquentSettings;

use LaravelEloquentSettings\Enums\SettingValueType;

/**
 * Class SettingDefinitionItem
 *
 * Represents a single setting definition item.
 *
 * @package LaravelEloquentSettings
 */
class SettingDefinitionItem
{
    protected string $name;
    protected SettingValueType $type;
    protected mixed $default = null;
    protected bool $insertOnDefault = true;
    protected bool $nullable = false;
    protected ?array $customValidationRules = null;

    /**
     * SettingDefinitionItem constructor.
     *
     * @param string $name
     */
    private function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Create a new instance of SettingDefinitionItem with the specified name.
     *
     * @param string $name
     * @return SettingDefinitionItem
     */
    public static function name(string $name): self
    {
        return new self($name);
    }

    /**
     * Set the type of the setting.
     *
     * @param SettingValueType $type
     * @return $this
     */
    public function type(SettingValueType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Set the default value of the setting.
     *
     * @param mixed $default
     * @return $this
     */
    public function default(mixed $default): self
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Mark the setting as nullable.
     *
     * @return $this
     */
    public function nullable(): self
    {
        $this->nullable = true;

        return $this;
    }

    /**
     * Disable inserting the setting when the default value is used.
     *
     * @return $this
     */
    public function disableInsertOnDefault(): self
    {
        $this->insertOnDefault = false;

        return $this;
    }

    /**
     * Set custom validation rules for the setting.
     *
     * @param array $rules
     * @return $this
     */
    public function validationRules(array $rules): self
    {
        $this->customValidationRules = $rules;

        return $this;
    }

    /**
     * Convert the item to a SettingDefinitionEntity.
     *
     * @return SettingDefinitionEntity
     */
    public function toEntity(): SettingDefinitionEntity
    {
        return new SettingDefinitionEntity(
            $this->name,
            $this->type,
            $this->default,
            $this->insertOnDefault,
            $this->nullable,
            $this->customValidationRules
        );
    }
}
