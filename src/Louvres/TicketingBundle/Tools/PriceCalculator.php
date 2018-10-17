<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 11/10/2018
 * Time: 15:04
 */

namespace Louvres\TicketingBundle\Tools;

use Symfony\Component\HttpFoundation\Request;
use Louvres\TicketingBundle\Tools\AgeCalculator;
use Louvres\TicketingBundle\Tools\PriceByVisitor;

class PriceCalculator
{
    public function calculPrix(Request $request)
    {
        $prix=0;
        $nbVisitor = $request->getSession()->get('resa')->getQuantity();

        $ageC = new AgeCalculator();
        $priceByVC = new PriceByVisitor();

        for ($i=0;$i < $nbVisitor;$i++)
        {
            $visitor = $request->getSession()->get('visitors')[$i];

            $reduction = $visitor->getReduction();
            $birthdate = $visitor->getBirthdate();

            $age = $ageC->calculAge($birthdate);

            $prixVisitor = $priceByVC->calculPrixByVisitor($request,$age,$reduction);
            $visitor->setPrice($prixVisitor);

            $prix=$prix+$prixVisitor;
        }
        return $prix;
    }
}