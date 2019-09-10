<?php

namespace Wnx\LaravelStats\Classifiers;

use Wnx\LaravelStats\ReflectionClass;
use Wnx\LaravelStats\Contracts\Classifier;
use Illuminate\Http\Resources\Json\JsonResource;

class ResourceClassifier implements Classifier
{
    public function name(): string
    {
        return 'Resources';
    }

    public function satisfies(ReflectionClass $class): bool
    {
        return $class->isSubclassOf(JsonResource::class);
    }

    public function countsTowardsApplicationCode(): bool
    {
        return true;
    }

    public function countsTowardsTests(): bool
    {
        return false;
    }
}
