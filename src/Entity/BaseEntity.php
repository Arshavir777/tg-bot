<?php

namespace App\Entity;

class BaseEntity
{
    public function __construct(array $properties = [])
    {
        $this->assignProperties($properties);
    }

    protected function assignProperties(array $properties)
    {
        foreach ($properties as $name => $value) {
            $key = str_replace('_', '', ucwords($name, '_'));
            $method = 'set' . $key;
            if (!method_exists($this, $method)) {
                dump($method);
                throw new \Exception('Something bad');
            }
            $this->$method($value);
        }
    }
}
