<?php

class staff extends \rex_yform_manager_dataset
{
    public static function getQR($staff)
    {
        $replace = [];
        $replace["%firstname%"] = $staff->getFirstName();
        $replace["%lastname%"] = $staff->getLastName();
        $replace["%title%"] = $staff->getTitle();
        $replace["%company%"] = $staff->getCompany();
        $replace["%street%"] = $staff->getStreet();
        $replace["%zip%"] = $staff->getZip();
        $replace["%city%"] = $staff->getCity();
        $replace["%country%"] = $staff->getCountry();
        $replace["%tel-cell%"] = $staff->getPhoneMobile();
        $replace["%tel-home%"] = $staff->getPhoneHome();
        $replace["%tel-work%"] = $staff->getPhoneWork();
        $replace["%email-home%"] = $staff->getMailHome();
        $replace["%email-work%"] = $staff->getMailWork();
        $replace["%url%"] = $staff->getUrl();
        return (new QRCode)->render(str_replace($find, $replace, $fragment));
    }

    public static function getVcf($staff)
    {
        // https://github.com/jeroendesloovere/vcard
        $vcard = new VCard();

        // add personal data
        $vcard->addName($staff->getLastName(), $staff->getFirstName(), "", $staff->getTitle(), "");

        $vcard->addCompany($staff->getCompany());
        // $vcard->addJobtitle();
        // $vcard->addRole();
        $vcard->addEmail();
        $vcard->addPhoneNumber($staff->getPhoneWork(), 'PREF;WORK');
        $vcard->addAddress(null, null, 'street', 'worktown', null, 'workpostcode', 'Belgium');
        $vcard->addURL($staff->getUrl());

        // $vcard->addPhoto(__DIR__ . '/landscape.jpeg');

        return $vcard->getOutput();
    }

    public function getFirstName()
    {
        return $this->getValue('firstname');
    }
    public function getLastName()
    {
        return $this->getValue('firstname');
    }
    public function getTitle()
    {
        return $this->getValue('title');
    }
    public function getCompany()
    {
        return $this->getValue('company');
    }
    public function getEmailWork()
    {
        return $this->getValue('email_work');
    }
    public function getEmailHome()
    {
        return $this->getValue('email_home');
    }
    public function getStreet()
    {
        return $this->getValue('street');
    }
    public function getCountry()
    {
        return $this->getValue('country');
    }
    public function getUrl()
    {
        return $this->getValue('url');
    }
    public function getTelCell()
    {
        return self::normalizePhone($this->getValue('phone'));
    }
    public function getTelWork()
    {
        return self::normalizePhone($this->getValue('phone_work'));
    }
    public function getTelHome()
    {
        return self::normalizePhone($this->getValue('phone_home'));
    }
    
    public static function normalizePhone($phone)
    {
        $phone =  preg_replace('~[^\d\+]~', '', $phone);
        if (substr($phone, 0, 2) == "00") {
            $phone = "+". ltrim($phone, '00');
        }
        if (substr($phone, 0, 2) == "0") {
            $phone = "+49". ltrim($phone, '0');
        }
        return $phone;
    }
}
