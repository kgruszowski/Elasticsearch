<?php

namespace AppBundle\Utils\Parser;

class TrendyolParser implements ProductParser
{
    const MAIN_NODE_NAME = "item";

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
            return (string)$this->row->title;
        }

        return null;
    }

    public function getImage()
    {
        if ($this->row) {
            return (string)$this->row->thumb_image_link;
        }

        return null;
    }

    public function getPrice()
    {
        if ($this->row) {
            return (string)$this->row->SalePrice;
        }

        return null;
    }
}
