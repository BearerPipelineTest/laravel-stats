<?php

namespace Wnx\LaravelStats\Classifiers;

use Wnx\LaravelStats\ReflectionClass;
use Illuminate\Database\Eloquent\Model;
use Wnx\LaravelStats\Contracts\Classifier;

class ModelClassifier implements Classifier
{
    public function getName() : string
    {
        return 'Models';
    }

    public function satisfies(ReflectionClass $class) : bool
    {
        return $class->isSubclassOf(Model::class);
    }
}
