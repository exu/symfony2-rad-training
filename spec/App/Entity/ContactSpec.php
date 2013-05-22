<?php
namespace spec\App\Entity;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContactSpec extends ObjectBehavior
{
    public function its_first_name_is_mutable()
    {
        $this->setFirstName('Szymon');
        $this->getFirstName()->shouldReturn('Szymon');
    }

    public function its_last_name_is_mutable()
    {
        $this->setLastName('Kovalski');
        $this->getLastName()->shouldReturn('Kovalski');
    }

    public function its_first_name_setter_is_fluent()
    {
        $this->setFirstName(Argument::any())->shouldReturn($this);
    }

    public function its_last_name_setter_is_fluent()
    {
        $this->setLastName(Argument::any())->shouldReturn($this);
    }
}