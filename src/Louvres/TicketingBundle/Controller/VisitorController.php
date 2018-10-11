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
    public function indexAction(Request $request)
    {
        $nbVisitor = $request->getSession()->get('resa')->getQuantity();

        for ($i=0;$i < $nbVisitor;$i++)
        {
            $visitor[] = new Visitor();
        }

        $formVisitors = $this
            ->createForm(CollectionType::class,$visitor,[
                'entry_type' => VisitorType::class,
                'entry_options' => ['label'=> false],
                ])
            ->add('save',SubmitType::class,['label'=>'Passer commande'])
            ->handleRequest($request);

        if ($formVisitors->isSubmitted() && $formVisitors->isValid()) {
            $request->getSession()->set('visitors',$visitor);

            return $this->redirectToRoute('louvres_ticketing_order');
        }

        return $this->render('@LouvresTicketing/Ticketing/visitor.html.twig',['form'=>$formVisitors ->createView()]);
    }
}