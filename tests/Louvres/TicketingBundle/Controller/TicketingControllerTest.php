<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 17/10/2018
 * Time: 17:17
 */

namespace Tests\Louvres\TicketingBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Louvres\TicketingBundle\Repository\BookingRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\TestCase;

class TicketingControllerTest extends WebTestCase
{
    public function testBookingFormSubmission()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/');

        $link = $crawler->selectLink('Billetterie')->link();
        $crawler = $client->click($link);

        $date=new \DateTime('2019-03-14');
        $date=$date->format('d/m/Y');

        $form= $crawler->selectButton('Valider')->form();
        $form['louvres_ticketingbundle_booking[name]'] = 'John Doe';
        $form['louvres_ticketingbundle_booking[email]'] = 'j.doe@gmail.com';
        $form['louvres_ticketingbundle_booking[dateVisit]'] = $date;
        $form['louvres_ticketingbundle_booking[type]'] = 1;
        $form['louvres_ticketingbundle_booking[quantity]'] = 4;

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertSame(1,$crawler->filter('h2:contains("Acheter vos billets d\'entrée 2/2")')->count()) ;
    }

    public function testLimitNumberVisitor()
    {
        $client = static::createClient();
        $crawler = $client->request('GET','/');

        $link = $crawler->selectLink('Billetterie')->link();
        $crawler = $client->click($link);

        $date=new \DateTime('2019-02-02');
        $date=$date->format('d/m/Y');

        $form= $crawler->selectButton('Valider')->form();
        $form['louvres_ticketingbundle_booking[name]'] = 'John Doe';
        $form['louvres_ticketingbundle_booking[email]'] = 'j.doe@gmail.com';
        $form['louvres_ticketingbundle_booking[dateVisit]'] = $date;
        $form['louvres_ticketingbundle_booking[type]'] = 1;
        $form['louvres_ticketingbundle_booking[quantity]'] = 1;

        $client->submit($form);
        $crawler = $client->followRedirect();

        $this->assertSame(1, $crawler->filter('div.flash-error')->count());
    }
}