<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 27/09/2018
 * Time: 11:03
 */

namespace Louvres\TicketingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PricesController extends Controller
{
    public function pricesAction()
    {
        return $this->render('@LouvresTicketing/Prices/prices.html.twig');
    }
}