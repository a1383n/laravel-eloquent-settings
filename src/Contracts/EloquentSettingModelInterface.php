<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\Enums\SettingValueType;

/**
 * Interface EloquentSettingModelInterface
 *
 * This interface defines the contract that EloquentSetting models should adhere to.
 */
interface EloquentSettingModelInterface
{
    /**
     * Get the name of the setting.
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get the value of the setting.
     *
     * @return mixed
     */
    public function getValue(): mixed;

    /**
     * Set the value type
     *
     * @param SettingValueType $type
     *
     * @return self
     */
    public function setType(SettingValueType $type): self;
}
