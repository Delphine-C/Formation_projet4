<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 02/10/2018
 * Time: 10:38
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Louvres\TicketingBundle\Controller\PriceController;
use Symfony\Component\HttpFoundation\Session\Session;

class OrderController extends Controller
{
    public function indexAction(Request $request)
    {
        $priceC = new PriceController();

        $prix = $priceC->calculPrix($request);
        $session = new Session();
        $session->set('prix',$prix);

        return $this->render('@LouvresTicketing/Ticketing/order.html.twig',['apiPublic'=>$this->container->getParameter('API_public'),'prix'=>$prix]);
    }
}