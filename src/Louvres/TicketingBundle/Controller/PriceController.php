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

class PriceController extends Controller
{
    public function calculPrix(Request $request)
    {
        $session=$request->getSession();

        $prix=0;
        $nbVisitor = $session->get('resa')->getQuantity();

        $ageC = new AgeController();

        for ($i=0;$i < $nbVisitor;$i++)
        {
            $visitor = $session->get('visitors')[$i];
            $reduction = $visitor->getReduction();
            $birthdate = $visitor->getBirthdate();

            $age = $ageC->calculAge($request,$birthdate);

            $prixVisitor = $this->calculPrixByVisitor($request,$age,$reduction);
            $prix=$prix+$prixVisitor;
        }

        return $prix;
    }

    public function calculPrixByVisitor(Request $request,$age,$reduction)
    {
        $session=$request->getSession();
        $jour = $session->get('resa')->getType();

        if(!$jour) {
            if ($age < 4) {
                $prix = 0;
            } else {
                $prix = 8;
            }
        } else {
            if ($age < 4) {
                $prix = 0;
            } elseif ($age < 12) {
                $prix = 8;
            } else{
                if($reduction) {
                    $prix = 10;
                } else {
                    if ($age > 60) {
                        $prix = 12;
                    } else {
                        $prix = 16;
                    }
                }
            }
        }
        return $prix;
    }
}