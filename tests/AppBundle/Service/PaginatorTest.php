<?php

namespace Tests\AppBundle\Service;

use AppBundle\Service\Paginator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PaginatorTest extends WebTestCase
{
    /** @var Paginator */
    protected static $paginator;

    public static function setUpBeforeClass()
    {
        $kernel = static::createKernel();
        $kernel->boot();
        self::$paginator = $kernel->getContainer()->get('paginator');
    }

    public function testSetPage()
    {
        self::$paginator->setPage(5);

        $this->assertEquals(5, self::$paginator->getCurrentPage());
    }

    public function testSetPageAsNull()
    {
        self::$paginator->setPage(null);

        $this->assertEquals(1, self::$paginator->getCurrentPage());
    }
}