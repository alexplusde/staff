<?php

use chillerlan\QRCode\QRCode;
use JeroenDesloovere\VCard\VCard;

class staff extends \rex_yform_manager_dataset
{
    public static function getQRCode($staff, $options = null)
    {
        $qrcode = new QRCode($options);
        return $qrcode->render(self::getVCard($staff));
    }

    public static function getVCard($staff)
    {
        // https://github.com/jeroendesloovere/vcard
        $vcard = new VCard();

        // add personal data
        $vcard->addName($staff->getLastName(), $staff->getFirstName(), '', $staff->getTitle(), '');

        $vcard->addCompany($staff->getCompany());
        // $vcard->addJobtitle();
        // $vcard->addRole();
        $vcard->addEmail($staff->getMailWork());
        $vcard->addPhoneNumber($staff->getPhoneWork(), 'PREF;WORK');
        $vcard->addAddress(null, null, $staff->getStreet(), $staff->getCity(), null, $staff->getZip(), $staff->getCountry());
        $vcard->addURL($staff->getUrl());

        // $vcard->addPhoto(__DIR__ . '/landscape.jpeg');

        return $vcard->getOutput();
    }

    public function getName()
    {
        return $this->getValue('fullname');
    }

    public function getDescription()
    {
        return $this->getValue('description');
    }

    public function getContent()
    {
        return $this->getValue('content');
    }

    public function getFirstName()
    {
        return $this->getValue('firstname');
    }

    public function getLastName()
    {
        return $this->getValue('lastname');
    }

    public function getTitle()
    {
        return $this->getValue('title');
    }

    public function getCompany()
    {
        if ('' == $this->getValue('company')) {
            return rex_config::get('staff', 'default_company_name');
        }
        return $this->getValue('company');
    }

    public function getMailWork()
    {
        return $this->getValue('email_work');
    }

    public function getMailHome()
    {
        return $this->getValue('email_home');
    }

    public function getStreet()
    {
        return $this->getValue('street');
    }

    public function getCity()
    {
        return $this->getValue('city');
    }

    public function getZip()
    {
        return $this->getValue('zip');
    }

    public function getCountry()
    {
        return $this->getValue('country');
    }

    public function getUrl()
    {
        return $this->getValue('url');
        if ('' == $this->getValue('company')) {
            return rex_config::get('staff', 'default_company_url');
        }
    }

    public function getPhoneCell()
    {
        return self::normalizePhone($this->getValue('phone'));
    }

    public function getPhoneWork()
    {
        return self::normalizePhone($this->getValue('phone_work'));
    }

    public function getPhoneHome()
    {
        return self::normalizePhone($this->getValue('phone_home'));
    }

    public function getImage()
    {
        return $this->getValue('image');
    }

    public static function normalizePhone($phone)
    {
        $phone = preg_replace('~[^\d\+]~', '', $phone);
        if ('00' == substr($phone, 0, 2)) {
            $phone = '+' . ltrim($phone, '00');
        }
        if ('0' == substr($phone, 0, 2)) {
            $phone = '+49' . ltrim($phone, '0');
        }
        return $phone;
    }
}
