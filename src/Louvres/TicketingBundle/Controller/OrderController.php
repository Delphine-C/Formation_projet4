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
        if ($request->getSession()->get('resa')->getType() === "1") {
            $type = "Journée";
        } else {
            $type = "Demi-journée";
        }

        if ($request->isMethod('POST')) {
            $apiSecret = $this->container->getParameter('API_secret');
            \Stripe\Stripe::setApiKey($apiSecret);

            $prix = $request->getSession()->get('prix') * 100;

            try {
                $charge = \Stripe\Charge::create(array(
                    "amount" => $prix,
                    "currency" => "eur",
                    "source" => $request->request->get('stripeToken'),
                    "description" => sprintf("Paiement de %s", $request->getSession()->get('resa')->getName()),
                ));

                $chargeID = $charge->id;
            } catch (\Stripe\Error\Card $e) {
                $this->addFlash('error', "Le paiement de votre commande a rencontré un problème. Veuillez recommencer l'opération.");
                return $this->redirectToRoute('louvres_ticketing_order');
            }

            $booking = $request->getSession()->get('resa');
            $booking->setPrice($prix);
            $booking->setOrderNum($chargeID);
            $this->getDoctrine()->getManager()->persist($booking);
            $this->getDoctrine()->getManager()->flush();

            $message = (new \Swift_Message('Vos billets pour le Musée du Louvre'))
                ->setFrom(['billetterie-louvre@mail.com' => 'Billetterie Louvre'])
                ->setTo($booking->getEmail())
                ->setBody(
                    $this->renderView(
                        '@LouvresTicketing/Mail/booking.html.twig', [
                            'nb' => $request->getSession()->get('resa')->getQuantity(),
                            'type' => $type,
                            'date' => $request->getSession()->get('resa')->getDatevisit()->format("d F Y"),
                            'prix' => $request->getSession()->get('prix'),
                            'commandeID' => $chargeID,
                            'visitors' => $request->getSession()->get('visitors'),
                        ]
                    ),
                    'text/html'
                );
            $this->get('mailer')->send($message);

            $this->addFlash('notice', "Votre commande a été passée avec succès. Vos billets vous ont été envoyés par mail.");
            return $this->redirectToRoute('louvres_ticketing_booking');
        }

        $priceC = new PriceCalculator();

        $prix = $priceC->calculPrix($request);
        $request->getSession()->set('prix', $prix);

        return $this->render('@LouvresTicketing/Ticketing/order.html.twig', [
            'apiPublic' => $this->container->getParameter('API_public'),
            'nb' => $request->getSession()->get('resa')->getQuantity(),
            'type' => $type,
            'date' => $request->getSession()->get('resa')->getDatevisit()->format("d F Y"),
            'prix' => $prix,
        ]);
    }
}