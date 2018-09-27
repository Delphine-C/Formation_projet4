<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 27/09/2018
 * Time: 11:27
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Louvres\TicketingBundle\Entity\Visitor;
use Louvres\TicketingBundle\Form\VisitorType;

class TicketingController extends Controller
{
    public function indexAction()
    {
        $visitor = new Visitor();
        $form = $this->createForm(VisitorType::class,$visitor);

        return $this->render('@LouvresTicketing/Ticketing/index.html.twig',array('form'=>$form->createView()));
    }
}