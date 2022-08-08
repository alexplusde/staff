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
        $replace["%email-home%"] = $staff->getMail();
        $replace["%email-work%"] = $staff->getMail();
        return (new QRCode)->render(str_replace($find, $replace, $fragment));
    }
}
