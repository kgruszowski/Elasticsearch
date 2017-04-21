<?php

namespace AppBundle\Utils\Parser;

class TagParser implements ProductParser
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
            return (string)$this->row->product_name;
        }

        return null;
    }

    public function getImage()
    {
        if ($this->row) {
            return (string)$this->row->picture_thumbnail_url;
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
