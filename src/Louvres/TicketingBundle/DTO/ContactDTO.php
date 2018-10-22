<?php
/**
 * Created by PhpStorm.
 * User: Delphine_Corneil
 * Date: 18/10/2018
 * Time: 11:33
 */

namespace Louvres\TicketingBundle\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class ContactDTO
{
    /*
     * @Assert\Length(
     *     min=2,
     *     max=40,
     *     minMessage = "La valeur saisie ne contient pas assez de caractères.",
     *     maxMessage = "La longueur de la chaîne de caractères est trop longue."
     * )
     */
    public $name;

    /*
     * @Assert\Email(message="L'adresse email n'est pas valide.")
     */
    public $email;

    /*
     * @Assert\Length(
     *     max=100,
     *     maxMessage = "La longueur de la chaîne de caractères est trop longue."
     * )
     */
    public $title;

    /*
     * @Assert\Length(
     *     max=400,
     *     maxMessage = "Le message est trop long. Soyez concis."
     * )
     */
    public $content;
}