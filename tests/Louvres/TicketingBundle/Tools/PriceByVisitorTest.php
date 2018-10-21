<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 18/10/2018
 * Time: 10:46
 */

namespace Tests\Louvres\TicketingBundle\Tools;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Louvres\TicketingBundle\Tools\PriceByVisitor;

class PriceByVisitorTest extends WebTestCase
{
    public function testCalculPriceByVisitor()
    {
        $priceByV = new PriceByVisitor();
        $result = $priceByV->calculPrixByVisitor(1, 62, 0);

        $this->assertSame(12, $result);
    }
}