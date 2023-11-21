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
    public function getName(): string
    {
        return $this->getValue('fullname');
    }

    public function getDescription(): string
    {
        return $this->getValue('description');
    }

    public function getContent(): string
    {
        return $this->getValue('content');
    }

    public function getFirstName(): string
    {
        return $this->getValue('firstname');
    }

    public function getLastName(): string
    {
        return $this->getValue('lastname');
    }

    public function getFullName(): string
    {
        if($this->getFirstname() == "") {
            return $this->getValue('lastname');
        }
        return $this->getValue('firstname') . ' ' . $this->getValue('lastname');
    }

    public function getTitle(): string
    {
        return $this->getValue('title');
    }

    public function getCompany(): string
    {
        if ('' == $this->getValue('company')) {
            return rex_config::get('staff', 'default_company_name');
        }
        return $this->getValue('company');
    }

    public function getMailWork(): string
    {
        return $this->getValue('email_work');
    }

    public function getMailHome(): string
    {
        return $this->getValue('email_home');
    }

    public function getStreet(): string
    {
        return $this->getValue('street');
    }

    public function getCity(): string
    {
        return $this->getValue('city');
    }

    public function getZip(): string
    {
        return $this->getValue('zip');
    }

    public function getCountry(): string
    {
        return $this->getValue('country');
    }

    public function getUrl(): string
    {
        if ('' == $this->getValue('company')) {
            return rex_config::get('staff', 'default_company_url');
        }
        return $this->getValue('url');
    }

    public function getPhoneCell(): string
    {
        return self::normalizePhone($this->getValue('phone'));
    }

    public function getPhoneWork(): string
    {
        return self::normalizePhone($this->getValue('phone_work'));
    }

    public function getPhoneHome(): string
    {
        return self::normalizePhone($this->getValue('phone_home'));
    }

    public function getImage(): string
    {
        return $this->getValue('image');
    }

    public function getMedia(): ?rex_media
    {
        if(rex_addon::exists('media_manager_responsive')) {
            return rex_media_plus::get($this->getValue('image'));
        }
        return rex_media::get($this->getValue('image'));
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
