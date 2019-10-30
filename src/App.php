<?php

namespace App;

class App
{
    /**
     * Collection of dependencies.
     *
     * @property array
     */
    protected static $dependency = [];

    /**
     * Binding dependencies to DIC.
     *
     * @param string
     * @param mixed
     *
     * @return void
     */
    public static function bind(string $key, $value): void
    {
        static::$dependency[$key] = $value;
    }

    /**
     * Getting dependency from DIC.
     *
     * @param string
     *
     * @return mixed
     */
    public static function get(string $key): mixed
    {
        if (array_key_exists($key, static::$dependency[$key])) {
            throw new \Exception("Can't find {$key} in DIC");
        }

        return static::$dependency[$key];
    }
}
