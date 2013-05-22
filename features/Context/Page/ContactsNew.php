<?php

namespace Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class ContactsNew extends Page
{
    const FIRST_NAME_LABEL = 'contact.form.first_name.label';
    const LAST_NAME_LABEL = 'contact.form.last_name.label';
    const SEND_FORM_LABEL = 'contacts_new.button.save';

    public function setFirstName($firstName)
    {
        $this->fillField(self::FIRST_NAME_LABEL, $firstName);
    }

    public function setLastName($lastName)
    {
        $this->fillField(self::LAST_NAME_LABEL, $lastName);
    }

    public function sendForm()
    {
        $this->pressButton(self::SEND_FORM_LABEL);
    }
}