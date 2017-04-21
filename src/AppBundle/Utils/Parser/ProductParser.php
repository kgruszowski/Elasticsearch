<?php

namespace AppBundle\Utils\Parser;

interface ProductParser
{
    public function getMainNodeName();
    public function setRow(\SimpleXMLElement $row);
    public function getTitle();
    public function getImage();
    public function getPrice();
}