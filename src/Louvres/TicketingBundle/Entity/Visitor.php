<?php

namespace Louvres\TicketingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Visitor
 *
 * @ORM\Table(name="visitor")
 * @ORM\Entity(repositoryClass="Louvres\TicketingBundle\Repository\VisitorRepository")
 */
class Visitor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var object
     *
     * @ORM\ManyToOne(targetEntity="Louvres\TicketingBundle\Entity\Booking", inversedBy="visitors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=20,
     *     minMessage = "La valeur saisie ne contient pas assez de caractères.",
     *     maxMessage = "La longueur de la chaîne de caractères est trop longue."
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=20,
     *     minMessage = "La valeur saisie ne contient pas assez de caractères.",
     *     maxMessage = "La longueur de la chaîne de caractères est trop longue."
     * )
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    private $birthdate;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="reduction", type="boolean")
     */
    private $reduction = false;

    public function __construct()
    {
        $this->country="FR";
        $this->price=0;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Visitor
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Visitor
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return Visitor
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set birthdate
     *
     * @param \DateTime $birthdate
     *
     * @return Visitor
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;
    }

    /**
     * Get birthdate
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * Set reduction
     *
     * @param boolean $reduction
     *
     * @return Visitor
     */
    public function setReduction($reduction)
    {
        $this->reduction = $reduction;
    }

    /**
     * Get reduction
     *
     * @return bool
     */
    public function getReduction()
    {
        return $this->reduction;
    }

    /**
     * Set booking
     *
     * @param object $booking
     */
    public function setBooking(Booking $booking)
    {
        $this->booking = $booking;
    }

    /**
     * Get booking
     *
     * @return object booking
     */
    public function getBooking()
    {
        return $this->booking;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}

