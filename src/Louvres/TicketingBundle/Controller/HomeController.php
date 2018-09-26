<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 26/09/2018
 * Time: 16:38
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
        return $this->render('@LouvresTicketing/Home/index.html.twig');
    }
}