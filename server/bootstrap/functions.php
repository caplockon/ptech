<?php
declare(strict_types=1);

use Illuminate\Database\Eloquent\Model;

if (! function_exists('ensure_having')) {
    /**
     * Check and throw error if the given object is null
     *
     * @template T
     * @param mixed|T $object
     * @param string|null $error
     * @return T
     */
    function ensure_having($object, ?string $error = null)
    {
        if (is_null($object)) {
            throw new UnexpectedValueException($error ?? "The given object is NULL");
        }

        return $object;
    }
}

if (! function_exists('table_of')) {
    /**
     * Get table name of model or class
     *
     * @param string|object|class-string<Model> $modelOrClass
     * @return string|null
     */
    function table_of($modelOrClass): ?string
    {
        if ($modelOrClass instanceof Model) {
            return $modelOrClass->getTable();
        }

        if (is_string($modelOrClass) && is_subclass_of($modelOrClass, Model::class)) {
            try {
                return call_user_func([
                    (new ReflectionClass($modelOrClass))->newInstanceWithoutConstructor(),
                    'getTable'
                ]);
            } catch (ReflectionException $e) {}
        }

        return null;
    }
}
