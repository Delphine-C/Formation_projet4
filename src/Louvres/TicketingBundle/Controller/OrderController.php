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

    public function paymentAction(Request $request)
    {
        $apiSecret = $this->container->getParameter('API_secret');
        \Stripe\Stripe::setApiKey($apiSecret);

        $session=$request->getSession();
        $prix = $session->get('prix') * 100;
        $description = "Paiement de ".$session->get('resa')->getName();

        try {
            \Stripe\Charge::create(array(
                "amount" => $prix,
                "currency" => "eur",
                "source" => $request->request->get('stripeToken'),
                "description" => $description
            ));
            $this->addFlash('notice',"Votre commande a été passée avec succès. Vos billets vous ont été envoyés par mail.");
            return $this->redirectToRoute('louvres_ticketing_booking');

        } catch(\Stripe\Error\Card $e) {
            $this->addFlash('notice',"Snif ça marche pas :(");
            return $this->redirectToRoute('louvres_ticketing_booking');
        }
    }
}