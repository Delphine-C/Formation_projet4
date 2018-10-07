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

        $session=$request->getSession();
        $prix = $session->get('prix') * 100;
        $description = "Paiement de ".$session->get('resa')->getName();
        $email = $session->get('resa')->getEmail();

        try {
            \Stripe\Charge::create(array(
                "amount" => $prix,
                "currency" => "eur",
                "source" => $request->request->get('stripeToken'),
                "description" => $description,
                "receipt_email" => $email,
            ));

            $booking = $session->get('resa');
            $booking->setPrice($prix);
            $em = $this->getDoctrine()->getManager();
            $em->persist($booking);
            $em->flush();

            $this->addFlash('notice',"Votre commande a été passée avec succès. Vos billets vous ont été envoyés par mail.");
            return $this->redirectToRoute('louvres_ticketing_booking');

        } catch(\Stripe\Error\Card $e) {
            $this->addFlash('notice',"Le paiement de votre commande a rencontré un problème. Veuillez recommencer l'opération.");
            return $this->redirectToRoute('louvres_ticketing_booking');
        }
    }
}