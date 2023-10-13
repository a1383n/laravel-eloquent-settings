<?php

namespace LaravelEloquentSettings\Contracts;

use LaravelEloquentSettings\SettingDefinitionEntity;

/**
 * Interface SettingResolverInterface
 *
 * This interface defines the contract for resolving settings based on a given entity.
 */
interface SettingResolverInterface
{
    /**
     * Resolve the setting value based on the provided entity.
     *
     * @param SettingDefinitionEntity $entity
     * @return mixed
     */
    public function __invoke(SettingDefinitionEntity $entity): mixed;
}
