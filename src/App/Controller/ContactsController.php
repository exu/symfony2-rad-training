<?php

namespace App\Controller;

use App\Entity\Contact;

class ContactsController extends Controller
{

    public function indexAction()
    {
        $contacts = $this->getRepository('App:Contact')->findAll();
        return ['contacts' => $contacts];
    }

    public function newAction()
    {
        $contact = new Contact();
        $form = $this->createBoundObjectForm($contact, 'new');

        if ($form->isBound() && $form->isValid()) {
            $this->persist($contact, true);
            $this->addFlash('success');

            return $this->redirectToRoute('app_contacts_index');
        }

        return ['form' => $form->createView()];
    }
}