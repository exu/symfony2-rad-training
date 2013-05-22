<?php

namespace spec\App\Controller;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityRepository;
use Knp\RadBundle\Form\FormManager;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormView;


class ContactsControllerSpec extends ObjectBehavior
{

    public function let(ContainerInterface $container, Registry $doctrine, ObjectManager $em, EntityRepository $repo, FormManager $forms)
    {
        $container->has('doctrine')->willReturn(true);
        $container->get('doctrine')->willReturn($doctrine);
        $container->get('knp_rad.form.manager')->willReturn($forms);
        $doctrine->getManager()->willReturn($em);
        $em->getRepository('App:Contact')->willReturn($repo);
        $this->setContainer($container);
    }

    public function it_is_controller()
    {
        $this->shouldHaveType('App\Controller\Controller');
    }


    public function its_index_return_contacts($repo)
    {
        $contacts = [];
        $repo->findAll()->willReturn($contacts);

        $this->indexAction()->shouldReturn(
            ['contacts' => $contacts]
        );
    }

    public function its_new_return_form(FormManager $forms, Form $form, FormView $formView)
    {
        $forms->createBoundObjectForm(Argument::type('\App\Entity\Contact'), 'new', Argument::type('array'))->willReturn($form);
        $form->createView()->willReturn($formView);
        $form->isBound()->willReturn(false);

        $this->newAction()->shouldReturn(
            ['form' => $formView]
        );
    }
}
