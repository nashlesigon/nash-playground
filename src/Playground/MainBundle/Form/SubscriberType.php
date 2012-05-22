<?php

namespace Playground\MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class SubscriberType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('email_address');
    }

    public function getName()
    {
        return 'subscriber';
    }

}