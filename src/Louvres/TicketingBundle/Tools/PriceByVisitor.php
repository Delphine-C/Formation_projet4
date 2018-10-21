<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 11/10/2018
 * Time: 15:07
 */

namespace Louvres\TicketingBundle\Tools;

class PriceByVisitor
{
    const NORMAL = 16;
    const CHILD = 8;
    const BABY = 0;
    const OLD = 12;
    const REDUCE = 10;
    const HALF_DAY = 8;

    public function calculPrixByVisitor($jour, $age, $reduction)
    {
        if (!$jour) {
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
            } else {
                if ($reduction) {
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