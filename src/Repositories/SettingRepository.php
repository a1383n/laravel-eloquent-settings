<?php

namespace LaravelEloquentSettings\Repositories;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use LaravelEloquentSettings\Contracts\EloquentSettingModelInterface;
use LaravelEloquentSettings\Contracts\SettingRepositoryInterface;
use LaravelEloquentSettings\Enums\SettingValueType;
use LaravelEloquentSettings\Models\EloquentSetting;

/**
 * Class SettingRepository
 *
 * Repository for managing and retrieving Eloquent settings.
 *
 * @package LaravelEloquentSettings\Repositories
 */
class SettingRepository implements SettingRepositoryInterface
{
    /**
     * SettingRepository constructor.
     *
     * @param MorphMany $morphManyRelation The morphMany relation for the settings.
     */
    public function __construct(protected readonly MorphMany $morphManyRelation)
    {
        //
    }

    /**
     * Get the query for a setting by name.
     *
     * @param string $name The name of the setting.
     * @return MorphMany<EloquentSetting> The morphMany relation query.
     */
    protected function getSettingByNameQuery(string $name): MorphMany
    {
        return $this->morphManyRelation
            ->where('name', '=', $name);
    }

    /**
     * @inheritDoc
     */
    public function getSettingByName(string $name): EloquentSettingModelInterface
    {
        return $this->getSettingByNameQuery($name)
            ->firstOrFail(['value']);
    }

    /**
     * @inheritDoc
     */
    public function updateSettingByName(string $name, SettingValueType $type, mixed $value): bool|EloquentSettingModelInterface
    {
        $result = $this->getSettingByNameQuery($name)
            ->update(['value' => $value]);

        if ($result !== 1) {
            // Model not exists, try to create it
            return $this->createSettingByName($name, $type, $value);
        } else {
            return true;
        }
    }

    /**
     * @inheritDoc
     */
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
