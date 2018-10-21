<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 17/10/2018
 * Time: 15:12
 */

namespace Tests\Louvres\TicketingBundle\Tools;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Louvres\TicketingBundle\Tools\AgeCalculator;

class AgeCalculatorTest extends WebTestCase
{
    public function testCalculAge()
    {
        $ageCalc = new AgeCalculator();
        $birthdate = new \DateTime('1956-10-10');
        $result = $ageCalc->calculAge($birthdate);

        $this->assertSame(62, $result);
    }
}