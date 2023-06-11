<?php
declare(strict_types=1);

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
