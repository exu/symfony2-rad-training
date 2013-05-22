<?php

namespace Context;

use Behat\MinkExtension\Context\MinkDictionary;
use SensioLabs\Behat\PageObjectExtension\Context\PageObjectContext;

class HomeContext extends PageObjectContext
{
    /**
     * @When /^I follow list contact link$/
     */
    public function iFollowListContactLink()
    {
        $this->getPage('Homepage')->followContactListLink();
    }
}