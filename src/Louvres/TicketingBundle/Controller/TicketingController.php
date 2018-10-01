<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 27/09/2018
 * Time: 11:27
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Louvres\TicketingBundle\Entity\Booking;
use Louvres\TicketingBundle\Form\BookingType;
use Louvres\TicketingBundle\Entity\Visitor;
use Louvres\TicketingBundle\Form\VisitorType;

class TicketingController extends Controller
{
    public function indexAction()
    {
        $booking = new Booking();
        $form_first = $this->createForm(BookingType::class,$booking);

        $visitor = new Visitor();
        $form = $this->createForm(VisitorType::class,$visitor);

        return $this->render('@LouvresTicketing/Ticketing/index.html.twig',array('form_first'=>$form_first->createView(),'form'=>$form->createView()));
    }
}