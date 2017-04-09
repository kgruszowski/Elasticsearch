<?php

namespace AppBundle\Utils\Parser;

interface ParserCreator
{
    public static function create($parserName);
}