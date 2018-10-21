<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 27/09/2018
 * Time: 11:27
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Louvres\TicketingBundle\Entity\Booking;
use Louvres\TicketingBundle\Form\BookingType;

class TicketingController extends Controller
{
    public function indexAction(Request $request)
    {
        $booking = new Booking();
        $formBooking = $this
            ->createForm(BookingType::class, $booking)
            ->handleRequest($request);

        if ($formBooking->isSubmitted() && $formBooking->isValid()) {
            $request->getSession()->set('resa', $booking);

            $selectedDate = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('LouvresTicketingBundle:Booking')
                ->findByDateVisit($booking->getDateVisit());

            $nbVisitor = 0;
            foreach ($selectedDate as $date) {
                $nbVisitor += $date->getQuantity();
            }

            if ($nbVisitor > 1000) {
                $this->addFlash('error', "Il n'y a plus de billets disponibles pour le jour sélectionné. Veuillez choisir une autre date.");

                return $this->redirectToRoute('louvres_ticketing_booking');
            }

            return $this->redirectToRoute('louvres_ticketing_visitor');
        }

        return $this->render('@LouvresTicketing/Ticketing/index.html.twig', [
            'form' => $formBooking->createView()
        ]);
    }
}