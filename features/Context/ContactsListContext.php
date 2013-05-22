<?php

namespace Context;

use App\Entity\Contact;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkDictionary;
use Behat\Symfony2Extension\Context\KernelDictionary;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;

class ContactsListContext extends PageObjectContext
{
    use KernelDictionary;

    /**
     * @Given /^I have available contacts:$/
     */
    public function iHaveAvailableContacts(TableNode $table)
    {
        $em = $this->getKernel()->getContainer()->get('doctrine.orm.entity_manager');

        foreach ($table->getHash() as $row) {
            $contact = new Contact();
            $contact->setFirstName($row['firstName']);
            $contact->setLastName($row['lastName']);

            $em->persist($contact);
        }

        $em->flush();
    }

    /**
     * @Then /^I should see (\d+) contacts in$/
     */
    public function iShouldSeeContactsIn($number)
    {
        $count = $this->getPage('ContactsList')->getContactsCount();

        if ($number != $count) {
            throw new \Exception(sprintf('There is %s contacts but should be %s', $count, $number));
        }
    }

    /**
     * @Given /^I should see success add contact notification$/
     */
    public function iShouldSeeSuccessAddContactNotification()
    {
        if (false === $this->getPage('ContactsList')->haveAddSuccessNotification()) {
            throw new \Exception(sprintf("There is no success add notification on page"));
        }
    }
}