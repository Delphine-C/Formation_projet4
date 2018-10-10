<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 10/10/2018
 * Time: 11:22
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CreditsController extends Controller
{
    public function indexAction()
    {
        return $this->render('@LouvresTicketing/credits.html.twig');
    }
}