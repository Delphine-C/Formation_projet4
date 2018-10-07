<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 07/10/2018
 * Time: 13:01
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PriceByVisitorController extends Controller
{
    const NORMAL = 16;
    const CHILD = 8;
    const BABY = 0;
    const OLD = 12;
    const REDUCE = 10;
    const HALF_DAY = 8;

    public function calculPrixByVisitor(Request $request,$age,$reduction)
    {
        $session=$request->getSession();
        $jour = $session->get('resa')->getType();

        if(!$jour) {
            if ($age < 4) {
                $prix = self::BABY;
            } else {
                $prix = self::HALF_DAY;
            }
        } else {
            if ($age < 4) {
                $prix = self::BABY;
            } elseif ($age < 12) {
                $prix = self::CHILD;
            } else{
                if($reduction) {
                    $prix = self::REDUCE;
                } else {
                    if ($age > 60) {
                        $prix = self::OLD;
                    } else {
                        $prix = self::NORMAL;
                    }
                }
            }
        }
        return $prix;
    }
}