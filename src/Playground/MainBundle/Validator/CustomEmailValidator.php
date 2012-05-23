<?php

namespace Playground\MainBundle\Validator;

use Doctrine\ORM\EntityManager;
// use Playground\MainBundle\Entity\Subscriber;
// use Symfony\Component\Validator\Constraint;
// use Symfony\Component\Validator\ConstraintValidator;

class CustomEmailValidator
{
    public function isValid($value, EntityManager $em)
    {
        $query = $em->createQuery('SELECT a FROM PlaygroundMainBundle:Subscriber a WHERE a.emailAddress = :email');
        $query->setParameter('email', $value);
        $obj = $query->getOneOrNullResult();
        if(is_null($obj))
        {
            return true;
        }
        return false;
    }
}