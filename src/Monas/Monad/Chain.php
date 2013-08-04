<?php

namespace Monas\Monad;

class Chain extends \MonadPHP\Monad
{
    public function __toString()
    {
        return (string) $this->extract();
    }

    public function __call($method, $args)
    {
        return $this->bind(
            function ($obj) use ($method, $args) {
                return $obj !== null ? call_user_func_array(array($obj, $method), $args) : null;
            }
        );
    }

    public function __get($name)
    {
        return $this->bind(
            function ($obj) use ($name) {
                return $obj !== null ? $obj->$name : null;
            }
        );
    }

    public function __set($name, $value)
    {
        return $this->bind(
            function ($obj) use ($name, $value) {
                if ($obj !== null) {
                    $obj->$name = $value;
                }
            }
        );
    }
}
