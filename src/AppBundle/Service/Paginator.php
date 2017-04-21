<?php

namespace AppBundle\Service;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class Paginator
{
    const ITEM_PER_PAGE = 20;

    protected $router;
    protected $page;
    protected $total;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function setPage($page)
    {
        $this->page = $page ? $page : 1;
    }

    public function getCurrentPage()
    {
        return $this->page;
    }

    public function paginate(int $total): array
    {
        $totalPages = ceil($total/Paginator::ITEM_PER_PAGE);
        $result = [];

        for ($i = $this->page; $i < $this->page+3; $i++) {
            if ($i < $totalPages) {
                $result[$i] = $i;
            }
        }

        for ($i = $this->page-1; $i > $this->page-3; $i--) {
            if ($i > 0) {
                $result[$i] = $i;
            }
        }

        ksort($result);
        return $result;
    }

    public function getStartIndex()
    {
        return $this->page * self::ITEM_PER_PAGE - self::ITEM_PER_PAGE;
    }

}