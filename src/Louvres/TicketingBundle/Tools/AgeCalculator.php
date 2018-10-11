<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 11/10/2018
 * Time: 15:02
 */

namespace Louvres\TicketingBundle\Tools;

use Symfony\Component\HttpFoundation\Request;

class AgeCalculator
{
    public function calculAge(Request $request,$birthdate)
    {
        $today = new \Datetime();
        $age = $today->diff($birthdate,true)->y;

        return $age;
    }
}