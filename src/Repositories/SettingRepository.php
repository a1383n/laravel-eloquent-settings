<?php

namespace LaravelEloquentSettings\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use LaravelEloquentSettings\Contracts\EloquentSettingModelInterface;
use LaravelEloquentSettings\Contracts\SettingRepositoryInterface;
use LaravelEloquentSettings\Enums\SettingValueType;
use LaravelEloquentSettings\Models\EloquentSetting;

class SettingRepository implements SettingRepositoryInterface
{
    public function __construct(protected readonly MorphMany $morphManyRelation)
    {
        //
    }

    /**
     * @param string $name
     * @return MorphMany<EloquentSetting>
     */
    protected function getSettingByNameQuery(string $name): MorphMany
    {
        return $this->morphManyRelation
            ->where('name', '=', $name);
    }

    public function getSettingByName(string $name): EloquentSettingModelInterface
    {
        return $this->getSettingByNameQuery($name)
            ->first(['value']) ?? throw new ModelNotFoundException();
    }

    public function updateSettingByName(string $name, SettingValueType $type, mixed $value): bool|EloquentSettingModelInterface
    {
        $result = $this->getSettingByNameQuery($name)
            ->update(['value' => $value]);

        if ($result !== 1) {
            // Model not exists try to create that
            return $this->createSettingByName($name, $type, $value);
        } else {
            return true;
        }
    }

    public function createSettingByName(string $name, SettingValueType $type, mixed $value): EloquentSettingModelInterface
    {
        $model = (new EloquentSetting(['name' => $name]))
            ->mergeCasts(['value' => $type->value])
            ->setAttribute('value', $value)
            ->setAttribute($this->morphManyRelation->getMorphType(), $this->morphManyRelation->getMorphClass())
            ->setAttribute($this->morphManyRelation->getForeignKeyName(), $this->morphManyRelation->getParentKey());

        $model->saveOrFail();

        return $model;
    }
}
