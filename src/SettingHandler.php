<?php

namespace LaravelEloquentSettings;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use LaravelEloquentSettings\Contracts\EloquentSettingModelInterface;
use LaravelEloquentSettings\Contracts\SettingHandlerInterface;
use LaravelEloquentSettings\Contracts\SettingRepositoryInterface;

/**
 * Class SettingHandler
 *
 * Handles the creation, update, and retrieval of settings.
 *
 * @package LaravelEloquentSettings
 */
class SettingHandler implements SettingHandlerInterface
{
    /**
     * SettingHandler constructor.
     *
     * @param SettingRepositoryInterface $repository
     */
    public function __construct(protected readonly SettingRepositoryInterface $repository)
    {
        //
    }

    /**
     * @inheritDoc
     */
    public function createSetting(SettingDefinitionEntity $entity, mixed $value): void
    {
        $this->validateValue($entity, $value);

        $this->repository->createSettingByName($entity->name, $entity->type, $value);
    }

    /**
     * @inheritDoc
     */
    public function updateSetting(SettingDefinitionEntity $entity, mixed $value): void
    {
        $this->validateValue($entity, $value);

        $this->repository->updateSettingByName($entity->name, $entity->type, $value);
    }

    /**
     * @inheritDoc
     */
    public function getSetting(SettingDefinitionEntity $entity): EloquentSettingModelInterface
    {
        return $this->repository->getSettingByName($entity->name);
    }

    /**
     * Validate the value of a setting.
     *
     * @param SettingDefinitionEntity $entity
     * @param mixed $value
     * @return void
     *
     * @throws ValidationException|\Throwable
     */
    private function validateValue(SettingDefinitionEntity $entity, mixed $value): void
    {
        $rules = array_merge(['present', $entity->type->value], $entity->customValidationRules ?? []);

        $validator = Validator::make(['value' => $value], ['value' => $rules]);

        throw_if($validator->fails(), ValidationException::class, $validator);
    }
}
