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
            ->createForm(ContactType::class, $contact)
            ->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            // Test recaptcha
            $secret = $this->container->getParameter('captcha_secret'); // votre clé privée
            $response = $_POST['g-recaptcha-response'];// Paramètre renvoyé par le recaptcha
            $remoteip = $_SERVER['REMOTE_ADDR'];// On récupère l'IP de l'utilisateur
            $api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
                . $secret
                . "&response=" . $response
                . "&remoteip=" . $remoteip ;

            $decode = json_decode(file_get_contents($api_url), true);

            if ($decode['success'] == true) {
                $monMail = $this->container->getParameter('mail_address');

                $message = (new \Swift_Message("Un message via le Musée du Louvre"))
                    ->setFrom(['billetterie-louvre@mail.com' => 'Billetterie Louvre'])
                    ->setTo($monMail)
                    ->setBody(
                        $this->renderView(
                            '@LouvresTicketing/Mail/contact.html.twig', [
                                'contact' => $contact
                            ]
                        ),
                        'text/html'
                    );
                $this->get('mailer')->send($message);

                $this->addFlash('notice', "Votre mail a bien été envoyé.");
                return $this->redirectToRoute('louvres_ticketing_contact');
            }

            else {
                $this->addFlash('error', "Votre mail n'a pu être envoyé. Veuillez réessayer.");

                return $this->render('@LouvresTicketing/Contact/contact.html.twig', [
                    'form' => $formContact->createView(),
                    'apiPublic' => $this->container->getParameter('captcha_public')
                ]);
            }
        }

        return $this->render('@LouvresTicketing/Contact/contact.html.twig', [
            'form' => $formContact->createView(),
            'apiPublic' => $this->container->getParameter('captcha_public')
        ]);
    }
}