<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 07/10/2018
 * Time: 12:54
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AgeController extends Controller
{
    public function calculAge(Request $request,$birthdate)
    {
        $today = new \Datetime();
        $age = $today->diff($birthdate,true)->y;

        return $age;
    }
}