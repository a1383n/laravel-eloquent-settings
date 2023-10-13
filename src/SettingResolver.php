<?php

namespace LaravelEloquentSettings;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use LaravelEloquentSettings\Contracts\SettingResolverInterface;

/**
 * Class SettingResolver
 *
 * Resolves the value of a setting. If the setting does not exist, it creates the setting with the default value.
 *
 * @package LaravelEloquentSettings
 */
class SettingResolver implements SettingResolverInterface
{
    /**
     * SettingResolver constructor.
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
    public function __invoke(SettingDefinitionEntity $entity): mixed
    {
        try {
            return $this->handler->getSetting($entity)
                ->setType($entity->type)
                ->getValue();
        } catch (ModelNotFoundException) {
            // If the setting does not exist, create it with the default value after return response
            app()->terminating(fn () => $this->handler->createSetting($entity, $entity->default));

            return $entity->default;
        }
    }
}
