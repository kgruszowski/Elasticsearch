<?php

namespace AppBundle\Utils\Parser;

use AppBundle\Utils\Exception\ClassNotFoundException;

class ParserFactory implements ParserCreator
{

    public static function create($parserName): ProductParser
    {
        $class = sprintf('AppBundle\Utils\Parser\%sParser', ucfirst($parserName));

        if (!class_exists($class)) {
            throw new ClassNotFoundException(sprintf("Class %s not found", $class));
        }

        return new $class();
    }
}
