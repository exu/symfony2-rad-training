<?php

namespace spec\App\Form;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\Form\FormBuilder;

class NewContactTypeSpec extends ObjectBehavior
{
    function it_is_form()
    {
        $this->shouldHaveType('Symfony\Component\Form\AbstractType');
    }

    function it_has_add_contact_name()
    {
        $this->getName()->shouldReturn('new_contact');
    }

    function it_is_build_form_with_first_and_last_name(FormBuilder $builder)
    {
        $builder->add('firstName', 'text', Argument::any())->shouldBeCalled()->willReturn($builder);
        $builder->add('lastName', 'text', Argument::any())->shouldBeCalled()->willReturn($builder);

        $this->buildForm($builder, []);
    }
}