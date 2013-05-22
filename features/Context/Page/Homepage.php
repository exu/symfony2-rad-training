<?php

namespace Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class Homepage extends Page
{
    const CONTACT_LIST_LINK = 'homepage.link.contact_list';

    public function followContactListLink()
    {
        $this->clickLink(self::CONTACT_LIST_LINK);
    }
}
