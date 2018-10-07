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

        if ($session->get('resa')->getType() === "1") {
            $type ="Journée";
        } else {
            $type = "Demi-journée";
        }

        return $this->render('@LouvresTicketing/Ticketing/order.html.twig',[
            'apiPublic'=>$this->container->getParameter('API_public'),
            'nb' => $session->get('resa')->getQuantity(),
            'type' => $type,
            'date' => $session->get('resa')->getDatevisit()->format("d F Y"),
            'prix'=>$prix,
        ]);
    }
}