<?php

namespace LaravelEloquentSettings;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use LaravelEloquentSettings\Contracts\EloquentSettingModelInterface;
use LaravelEloquentSettings\Contracts\SettingHandlerInterface;
use LaravelEloquentSettings\Contracts\SettingRepositoryInterface;

class SettingHandler implements SettingHandlerInterface
{

    public function __construct(protected readonly SettingRepositoryInterface $repository)
    {
        //
    }

    public function createSetting(SettingDefenationEntity $entity, mixed $value): void
    {
        $this->validateValue($entity, $value);

        $this->repository->createSettingByName($entity->name, $entity->type, $value);
    }

    public function updateSetting(SettingDefenationEntity $entity, mixed $value): void
    {
        $this->validateValue($entity, $value);

        $this->repository->updateSettingByName($entity->name, $entity->type, $value);
    }

    public function getSetting(SettingDefenationEntity $entity): EloquentSettingModelInterface
    {
        return $this->repository->getSettingByName($entity->name);
    }

    private function validateValue(SettingDefenationEntity $entity, mixed $value): void
    {
        $rules = array_merge(['present', $entity->type->value], $entity->customValidationRules ?? []);

        $validator = Validator::make(['value' => $value], ['value' => $rules]);

        throw_if($validator->fails(), ValidationException::class, $validator);
    }
}
