<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 07/10/2018
 * Time: 13:18
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentController extends Controller
{
    public function paymentAction(Request $request)
    {
        $apiSecret = $this->container->getParameter('API_secret');
        \Stripe\Stripe::setApiKey($apiSecret);

        $prix = $request->getSession()->get('prix') * 100;

        try {
            \Stripe\Charge::create(array(
                "amount" => $prix,
                "currency" => "eur",
                "source" => $request->request->get('stripeToken'),
                "description" => sprintf("Paiement de %s",$request->getSession()->get('resa')->getName()),
            ));
        } catch(\Stripe\Error\Card $e) {
            $this->addFlash('notice',"Le paiement de votre commande a rencontré un problème. Veuillez recommencer l'opération.");
            return $this->redirectToRoute('louvres_ticketing_booking');
        }

        $booking = $request->getSession()->get('resa');
        $booking->setPrice($prix);
        $this->getDoctrine()->getManager()->persist($booking);
        $this->getDoctrine()->getManager()->flush();

        $this->addFlash('notice',"Votre commande a été passée avec succès. Vos billets vous ont été envoyés par mail.");
        return $this->redirectToRoute('louvres_ticketing_booking');
    }
}