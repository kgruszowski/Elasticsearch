<?php

namespace AppBundle\Utils\Parser;

class FarfetchParser implements ProductParser
{
    const MAIN_NODE_NAME = "product";

    protected $row;

    public function getMainNodeName()
    {
        return self::MAIN_NODE_NAME;
    }

    public function setRow(\SimpleXMLElement $row)
    {
        $this->row = $row;
    }

    public function getTitle()
    {
        if ($this->row) {
            return (string)$this->row->name;
        }

        return null;
    }

    public function getImage()
    {
        if ($this->row) {
            return (string)$this->row->mediumImage;
        }

        return null;
    }

    public function getPrice()
    {
        if ($this->row) {
            return (string)$this->row->price;
        }

        return null;
    }
}
