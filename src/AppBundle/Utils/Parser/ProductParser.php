<?php

namespace AppBundle\Utils\Parser;

interface ProductParser
{
    public function setRow(\SimpleXMLElement $row);
    public function getTitle();
}