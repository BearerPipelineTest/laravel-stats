<?php declare(strict_types=1);

namespace Wnx\LaravelStats\ShareableMetrics\Metrics;

use Illuminate\Support\Str;
use Wnx\LaravelStats\Contracts\CollectableMetric;
use Wnx\LaravelStats\ValueObjects\ClassifiedClass;

class ModelsExtendOtherModel extends Metric implements CollectableMetric
{
    public function name(): string
    {
        return 'models_extend_model';
    }

    public function value()
    {
        $models = $this->project
                ->classifiedClasses()
                ->filter(function (ClassifiedClass $classifiedClass) {
                    return $classifiedClass->classifier->name() === 'Models';
                });

        if ($models->count() === 0) {
            return null;
        }

        return $models
                ->reject(function (ClassifiedClass $classifiedClass) {
                    $parentClassName = $classifiedClass->reflectionClass->getParentClass()->getName();

                    // If a Model extends an Illuminate-class, remove it from the collection
                    // as we see it as a "normal" Model
                    return Str::of($parentClassName)->startsWith('Illuminate');
                })
                ->count() > 0;
    }
}