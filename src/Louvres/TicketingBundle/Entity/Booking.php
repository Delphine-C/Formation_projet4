<?php

namespace Louvres\TicketingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Booking
 *
 * @ORM\Table(name="booking")
 * @ORM\Entity(repositoryClass="Louvres\TicketingBundle\Repository\BookingRepository")
 */
class Booking
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min=2,
     *     max=40,
     *     minMessage = "La valeur saisie ne contient pas assez de caractères.",
     *     maxMessage = "La longueur de la chaîne de caractères est trop longue."
     * )
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     * @Assert\Email(message="L'adresse email n'est pas valide")
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_visit", type="date")
     */
    private $dateVisit;

    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean")
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="Louvres\TicketingBundle\Entity\Visitor",
     *     cascade={"persist"}, mappedBy="booking")
     */
    private $visitors;

    public function __construct()
    {
        $this->dateVisit = new \DateTime();
        $this->quantity = 1;
        $this->type = 1;
        $this->visitors = new ArrayCollection();
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
     * @return Booking
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
     * Set email
     *
     * @param string $email
     *
     * @return Booking
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set dateVisit
     *
     * @param string $dateVisit
     *
     * @return Booking
     */
    public function setDateVisit($dateVisit)
    {
        $this->dateVisit = $dateVisit;
    }

    /**
     * Get dateVisit
     *
     * @return string
     */
    public function getDateVisit()
    {
        return $this->dateVisit;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return Booking
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Booking
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Booking
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

    public function addVisitor(Visitor $visitor)
    {
        $this->visitors[] = $visitor; // $this->visistors->add($visitor)
        $visitor->setBooking($this);
    }

    public function getVisitors()
    {
        return $this->visitors;
    }
}

