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
        return (new QRCode)->render(str_replace($find, $replace, $fragment));
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
        return $this->getValue('firstname');
    }
    public function getCompany()
    {
        return $this->getValue('company');
    }
    public function getEmailWork()
    {
        return $this->getValue('email-work');
    }
    public function getEmailHome()
    {
        return $this->getValue('email-work');
    }
    public function getStreet()
    {
        return $this->getValue('street');
    }
    public function getCountry()
    {
        return $this->getValue('country');
    }
    public function getTelCell()
    {
        return $this->getValue('cell_phone');
    }
    public function getTelWork()
    {
        return $this->getValue('telephone_work');
    }
    public function getTelHome()
    {
        return $this->getValue('telephone_work');
    }
}
