<?php

namespace AppBundle\Utils\Parser;

class ModanisaParser implements ProductParser
{
    const MAIN_NODE_NAME = "urun";

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
            return (string)$this->row->baslik;
        }

        return null;
    }

    public function getImage()
    {
        if ($this->row) {
            return (string)$this->row->resimurl;
        }

        return null;
    }

    public function getPrice()
    {
        if ($this->row) {
            return (string)$this->row->fiyat;
        }

        return null;
    }
}
