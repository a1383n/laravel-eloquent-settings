<?php

namespace LaravelEloquentSettings\Contracts;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelEloquentSettings\Enums\SettingValueType;

/**
 * Interface SettingRepositoryInterface
 *
 * This interface defines the contract for interacting with the settings repository.
 */
interface SettingRepositoryInterface
{
    /**
     * Get a setting by name.
     *
     * @param string $name The name of the setting.
     * @return EloquentSettingModelInterface The retrieved setting model.
     *
     * @throws ModelNotFoundException If the setting is not found.
     */
    public function getSettingByName(string $name): EloquentSettingModelInterface;

    /**
     * Update a setting by name.
     *
     * @param string $name The name of the setting.
     * @param SettingValueType $type The type of the setting value.
     * @param mixed $value The new value for the setting.
     * @return bool|EloquentSettingModelInterface If the update is successful, returns true; otherwise, creates a new setting and returns the model.
     */
    public function updateSettingByName(string $name, SettingValueType $type, mixed $value): bool|EloquentSettingModelInterface;

    /**
     * Create a new setting by name.
     *
     * @param string $name The name of the setting.
     * @param SettingValueType $type The type of the setting value.
     * @param mixed $value The value for the new setting.
     * @return EloquentSettingModelInterface The created setting model.
     */
    public function createSettingByName(string $name, SettingValueType $type, mixed $value): EloquentSettingModelInterface;
}
