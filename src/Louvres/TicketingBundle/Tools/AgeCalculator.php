<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 11/10/2018
 * Time: 15:02
 */

namespace Louvres\TicketingBundle\Tools;

class AgeCalculator
{
    public function calculAge($birthdate)
    {
        $today = new \Datetime();
        $age = $today->diff($birthdate,true)->y;

        return $age;
    }
}