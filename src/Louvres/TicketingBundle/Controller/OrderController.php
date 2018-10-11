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
use Louvres\TicketingBundle\Tools\PriceCalculator;

class OrderController extends Controller
{
    public function indexAction(Request $request)
    {
        $priceC = new PriceCalculator();

        $prix = $priceC->calculPrix($request);
        $request->getSession()->set('prix',$prix);

        if ($request->getSession()->get('resa')->getType() === "1") {
            $type ="Journée";
        } else {
            $type = "Demi-journée";
        }

        return $this->render('@LouvresTicketing/Ticketing/order.html.twig',[
            'apiPublic'=>$this->container->getParameter('API_public'),
            'nb' => $request->getSession()->get('resa')->getQuantity(),
            'type' => $type,
            'date' => $request->getSession()->get('resa')->getDatevisit()->format("d F Y"),
            'prix'=>$prix,
        ]);
    }
}