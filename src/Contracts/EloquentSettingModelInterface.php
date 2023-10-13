<?php

namespace LaravelEloquentSettings\Contracts;

interface EloquentSettingModelInterface
{
    public function getName(): string;

    public function getValue(): mixed;
}