<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 18/10/2018
 * Time: 11:38
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Louvres\TicketingBundle\DTO\ContactDTO;
use Louvres\TicketingBundle\Form\ContactType;

class ContactController extends Controller
{
    public function sendAction(Request $request)
    {
        $contact = new ContactDTO();
        $formContact = $this
            ->createForm(ContactType::class,$contact)
            ->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {}

        return $this->render('@LouvresTicketing/Contact/contact.html.twig',[
            'form'=>$formContact->createView()
        ]);
    }
}