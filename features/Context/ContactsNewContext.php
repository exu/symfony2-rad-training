<?php

namespace Context;

use App\Entity\Contact;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkDictionary;
use Behat\Symfony2Extension\Context\KernelDictionary;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;

class ContactsNewContext extends PageObjectContext
{
    /**
     * @When /^I am fill "([^"]*)" in the first name field in contact form$/
     */
    public function iAmFillInTheFirstNameFieldInContactForm($firstName)
    {
        $this->getPage('ContactsNew')->setFirstName($firstName);
    }

    /**
     * @Given /^I am fill "([^"]*)" in the last name field in contact form$/
     */
    public function iAmFillInTheLastNameFieldInContactForm($lastName)
    {
        $this->getPage('ContactsNew')->setLastName($lastName);
    }

    /**
     * @Given /^I send contact form$/
     */
    public function iSendContactForm()
    {
        $this->getPage('ContactsNew')->sendForm();
    }
}