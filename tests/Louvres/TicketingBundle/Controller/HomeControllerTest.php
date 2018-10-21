<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 17/10/2018
 * Time: 10:36
 */

namespace Tests\Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomepageIsUp()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
    }
}