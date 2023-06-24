<?php
declare(strict_types=1);

namespace App\Concerns;

trait Making
{
    /**
     *
     * @template T
     * @param class-string<T> $class
     * @param ...$parameters
     * @return T
     */
    public function new(string $class, ...$parameters)
    {
        return app($class, $parameters);
    }
}
