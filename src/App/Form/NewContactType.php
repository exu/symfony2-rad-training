<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class NewContactType extends AbstractType
{

    public function getName()
    {
        return 'new_contact';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName', 'text', ['label' => 'contact.form.first_name.label'])
            ->add('lastName', 'text', ['label' => 'contact.form.last_name.label']);
    }
}