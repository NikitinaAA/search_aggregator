<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Log;
use ReflectionClass;
use ReflectionMethod;

trait RelationshipsTrait
{
    /**
     * @return array
     */
    public function getRelations()
    {
        try {
            $model = new static();
            $relations = [];

            $methods = (new ReflectionClass($model))->getMethods(ReflectionMethod::IS_PUBLIC);

            foreach ($methods as $method) {

                if ($method->class != get_class($model) || !empty($method->getParameters()) || $method->getName() == __FUNCTION__) {
                    continue;
                }

                if ($method->isStatic() || $method->isFinal()) {
                    continue;
                }

                $object = $method->invoke($model);

                if (!$object instanceof Relation) {
                    continue;
                }

                $relations[$method->getName()] = (new ReflectionClass($object->getRelated()))->getName();
            }

            return $relations;

        } catch (\ReflectionException $e) {
            Log::error($e->getMessage());
        }
    }
}
