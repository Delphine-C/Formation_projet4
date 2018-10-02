<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 02/10/2018
 * Time: 10:38
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class OrderController extends Controller
{
    public function indexAction()
    {
        return $this->render('@LouvresTicketing/Ticketing/order.html.twig',['apiPublic'=>$this->container->getParameter('API_public')]);
    }

    public function paymentAction(Request $request)
    {
        $apiSecret = $this->container->getParameter('API_secret');
        \Stripe\Stripe::setApiKey($apiSecret);

        try {
            \Stripe\Charge::create(array(
                "amount" => 2000,
                "currency" => "eur",
                "source" => $request->request->get('stripeToken'),
                "description" => "Paiement de test" // "Paiement de .'$variable'." ou nom client
            ));
            $this->addFlash("success","Bravo ça marche !");
            return $this->indexAction();

        } catch(\Stripe\Error\Card $e) {
            $this->addFlash("error","Snif ça marche pas :(");
            return $this->indexAction();
        }
    }
}