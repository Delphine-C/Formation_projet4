<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 05/10/2018
 * Time: 13:22
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Louvres\TicketingBundle\Entity\Visitor;
use Louvres\TicketingBundle\Controller\AgeController;
use Louvres\TicketingBundle\Controller\PriceByVisitorController;

class PriceController extends Controller
{
    public function calculPrix(Request $request)
    {
        $session=$request->getSession();

        $prix=0;
        $nbVisitor = $session->get('resa')->getQuantity();

        $ageC = new AgeController();
        $priceByVC = new PriceByVisitorController();

        for ($i=0;$i < $nbVisitor;$i++)
        {
            $visitor = $session->get('visitors')[$i];
            $reduction = $visitor->getReduction();
            $birthdate = $visitor->getBirthdate();

            $age = $ageC->calculAge($request,$birthdate);

            $prixVisitor = $priceByVC->calculPrixByVisitor($request,$age,$reduction);
            $prix=$prix+$prixVisitor;
        }
        return $prix;
    }
}