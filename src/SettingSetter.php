<?php

namespace LaravelEloquentSettings;

use LaravelEloquentSettings\Contracts\SettingSetterInterface;

/**
 * Class SettingSetter
 *
 * Sets the value of a setting. If the value is not provided and the setting is not nullable, it uses the default value.
 *
 * @package LaravelEloquentSettings
 */
class SettingSetter implements SettingSetterInterface
{
    /**
     * SettingSetter constructor.
     *
     * @param SettingHandler $handler
     */
    public function __construct(protected readonly SettingHandler $handler)
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function __invoke(SettingDefinitionEntity $entity, mixed $value = null): void
    {
        if ($value === null && ! $entity->nullable) {
            throw new \Exception(sprintf('(%s) setting is not nullable', $entity->name));
        }

        $this->handler->updateSetting($entity, $value ?? $entity->default);
    }
}
