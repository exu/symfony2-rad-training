<?php

namespace Context\Page;

use SensioLabs\Behat\PageObjectExtension\PageObject\Page;

class ContactsList extends Page
{
    const CONTACT_LIST_TABLE_ID = 'contact-list-table';
    const ADD_NOTIFICATION_SUCCESS = 'contact.add.success.notification';

    public function getContactsCount()
    {
        $tr = $this->findAll('css', sprintf('table#%s tbody tr', self::CONTACT_LIST_TABLE_ID));

        if (!$tr) {
            throw new \Exception(sprintf("There is no table with #id %s", self::CONTACT_LIST_TABLE_ID));
        }

        return count($tr);
    }

    public function haveAddSuccessNotification()
    {

    }
}