<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 27/09/2018
 * Time: 11:27
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TicketingBundle extends Controller
{
    public function indexAction()
    {
        return $this->render('@LouvresTicketing//.html.twig');
    }
}