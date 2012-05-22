<?php

namespace Playground\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints\Email;
/**
 * Playground\MainBundle\Entity\Subscriber
 */
class Subscriber
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $emailAddress
     */
    private $emailAddress;

    /**
     * @var datetime $dateAdded
     */
    private $dateAdded;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emailAddress
     *
     * @param string $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * Get emailAddress
     *
     * @return string 
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * Set dateAdded
     *
     * @param datetime $dateAdded
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;
    }

    /**
     * Get dateAdded
     *
     * @return datetime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }


    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
       $metadata->addPropertyConstraint('emailAddress', new Email(array("message" => "Please enter a valid email address.")));
    }

    public function isDuplicateEntry(ExecutionContext $context)
    {
        $qb = $this->createQueryBuilder();
        
    }
}