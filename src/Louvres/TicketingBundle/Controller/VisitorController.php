<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 05/10/2018
 * Time: 09:43
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Louvres\TicketingBundle\Entity\Visitor;
use Louvres\TicketingBundle\Form\VisitorType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VisitorController extends Controller
{
    public function indexAction(Request $request, $nbVisitor)
    {
        for ($i=0;$i < $nbVisitor;$i++)
        {
            $visitor[] = new Visitor();
        }

        $formVisitors = $this
            ->createForm(CollectionType::class,$visitor,[
                'entry_type' => VisitorType::class,
                'entry_options' => ['label'=> false],
                ])
            ->add('save',SubmitType::class,['label'=>'Passer commande']);

        if ($request->isMethod('POST') && $formVisitors ->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$em->persist($visitor);

            $session = new Session();
            $session->set('visitors',$visitor);

            return $this->redirectToRoute('louvres_ticketing_order');
        }

        return $this->render('@LouvresTicketing/Ticketing/visitor.html.twig',['form'=>$formVisitors ->createView()]);
    }
}