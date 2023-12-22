<?php

use chillerlan\QRCode\QRCode;
use JeroenDesloovere\VCard\VCard;

/**
 * Die Klasse Staff ist ein Dataset für den YOrm Manager in REDAXO.
 * Sie ermöglicht die Verwaltung von Mitarbeiterinformationen wie E-Mail-Adresse, Job, Vita usw.
 *
 * Beispiel:
 * ```php
 * $mitarbeiter = staff::create();
 * $mitarbeiter->setValue('job', 'Entwickler');
 * $mitarbeiter->save();
 * ```
 *
 */
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

    /**
     * Gibt den vollständigen Namen des Mitarbeiters zurück.
     *
     * @return string Der vollständige Name des Mitarbeiters.
     */
    public function getName(): string
    {
        return $this->getValue('fullname');
    }

    /**
     * Gibt die Beschreibung des Mitarbeiters zurück.
     *
     * @return string Die Beschreibung des Mitarbeiters.
     */
    public function getDescription(): string
    {
        return $this->getValue('description');
    }

    /**
     * Gibt den Inhalt des Mitarbeiters zurück.
     *
     * @return string Der Inhalt des Mitarbeiters.
     */
    public function getContent(): string
    {
        return $this->getValue('content');
    }
    /**
     * Gibt den Vornamen des Mitarbeiters zurück.
     *
     * @return string Der Vorname des Mitarbeiters.
     */
    public function getFirstName(): string
    {
        return $this->getValue('firstname');
    }

    /**
     * Gibt den Nachnamen des Mitarbeiters zurück.
     *
     * @return string Der Nachname des Mitarbeiters.
     */
    public function getLastName(): string
    {
        return $this->getValue('lastname');
    }

    /**
     * Gibt den vollständigen Namen des Mitarbeiters zurück.
     * Wenn kein Vorname vorhanden ist, wird nur der Nachname zurückgegeben.
     *
     * @return string Der vollständige Name des Mitarbeiters.
     */
    public function getFullName(): string
    {
        if ('' == $this->getFirstname()) {
            return $this->getValue('lastname');
        }
        return $this->getValue('firstname') . ' ' . $this->getValue('lastname');
    }
    /**
     * Gibt den Titel des Mitarbeiters zurück.
     *
     * @return string Der Titel des Mitarbeiters.
     */
    public function getTitle(): string
    {
        return $this->getValue('title');
    }

    /**
     * Gibt den Namen des Unternehmens des Mitarbeiters zurück.
     * Wenn kein Unternehmensname vorhanden ist, wird der Standardunternehmensname aus der Konfiguration zurückgegeben.
     *
     * @return string Der Name des Unternehmens des Mitarbeiters.
     */
    public function getCompany(): string
    {
        if ('' == $this->getValue('company')) {
            return rex_config::get('staff', 'default_company_name');
        }
        return $this->getValue('company');
    }

    /**
     * Gibt die berufliche E-Mail-Adresse des Mitarbeiters zurück.
     *
     * @return string Die berufliche E-Mail-Adresse des Mitarbeiters.
     */
    public function getMailWork(): string
    {
        return $this->getValue('email_work');
    }
    public function getMailHome(): string
    {
        return $this->getValue('email_home');
    }

    /**
     * Gibt die Straße der Adresse des Mitarbeiters zurück.
     *
     * @return string Die Straße der Adresse des Mitarbeiters.
     */
    public function getStreet(): string
    {
        return $this->getValue('street');
    }

    /**
     * Setzt die Straße der Adresse des Mitarbeiters.
     *
     * @param string $street Die neue Straße der Adresse des Mitarbeiters.
     */
    public function setStreet(string $street): self
    {
        $this->setValue('street', $street);
        return $this;
    }

    /**
     * Gibt die Stadt der Adresse des Mitarbeiters zurück.
     *
     * @return string Die Stadt der Adresse des Mitarbeiters.
     */
    public function getCity(): string
    {
        return $this->getValue('city');
    }

    /**
     * Setzt die Stadt der Adresse des Mitarbeiters.
     *
     * @param string $city Die neue Stadt der Adresse des Mitarbeiters.
     * @return $this
     */
    public function setCity(string $city): self
    {
        $this->setValue('city', $city);
        return $this;
    }

    /**
     * Gibt die Postleitzahl der Adresse des Mitarbeiters zurück.
     *
     * @return string Die Postleitzahl der Adresse des Mitarbeiters.
     */
    public function getZip(): string
    {
        return $this->getValue('zip');
    }

    /**
     * Setzt die Postleitzahl der Adresse des Mitarbeiters.
     *
     * @param string $zip Die neue Postleitzahl der Adresse des Mitarbeiters.
     * @return $this
     */
    public function setZip(string $zip): self
    {
        $this->setValue('zip', $zip);
        return $this;
    }

    /**
     * Gibt das Land der Adresse des Mitarbeiters zurück.
     *
     * @return string Das Land der Adresse des Mitarbeiters.
     */
    public function getCountry(): string
    {
        return $this->getValue('country');
    }

    /**
     * Setzt das Land der Adresse des Mitarbeiters.
     *
     * @param string $country Das neue Land der Adresse des Mitarbeiters.
     * @return $this
     */
    public function setCountry(string $country): self
    {
        $this->setValue('country', $country);
        return $this;
    }

    /**
     * Gibt die URL des Unternehmens des Mitarbeiters zurück.
     * Wenn keine Unternehmens-URL vorhanden ist, wird die Standard-Unternehmens-URL aus der Konfiguration zurückgegeben.
     *
     * @return string Die URL des Unternehmens des Mitarbeiters.
     */
    public function getUrl(): string
    {
        if ('' == $this->getValue('company')) {
            return rex_config::get('staff', 'default_company_url');
        }
        return $this->getValue('url');
    }
    /**
     * Gibt die Handynummer des Mitarbeiters zurück.
     *
     * @return string Die normalisierte Handynummer des Mitarbeiters.
     */
    public function getPhoneCell(): string
    {
        return self::normalizePhone($this->getValue('phone'));
    }

    /**
     * Gibt die Arbeitsnummer des Mitarbeiters zurück.
     *
     * @return string Die normalisierte Arbeitsnummer des Mitarbeiters.
     */
    public function getPhoneWork(): string
    {
        return self::normalizePhone($this->getValue('phone_work'));
    }

    /**
     * Gibt die Heimnummer des Mitarbeiters zurück.
     *
     * @return string Die normalisierte Heimnummer des Mitarbeiters.
     */
    public function getPhoneHome(): string
    {
        return self::normalizePhone($this->getValue('phone_home'));
    }

    /**
     * Gibt das Bild des Mitarbeiters zurück.
     *
     * @return string Der Pfad zum Bild des Mitarbeiters.
     */
    public function getImage(): string
    {
        return $this->getValue('image');
    }

    /**
     * Gibt das Medium des Mitarbeiters zurück.
     *
     * @return rex_media|null Das Medium des Mitarbeiters oder null, wenn es nicht existiert.
     */
    public function getMedia(): ?rex_media
    {
        if (rex_addon::exists('media_manager_responsive')) {
            return rex_media_plus::get($this->getValue('image'));
        }
        return rex_media::get($this->getValue('image'));
    }

    /**
     * Normalisiert die Telefonnummer.
     *
     * @param string $phone Die zu normalisierende Telefonnummer.
     * @return string Die normalisierte Telefonnummer.
     */
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

    /** @api */
    public function setFullname(mixed $value) : self
    {
        $this->setValue("fullname", $value);
        return $this;
    }

    /** @api */
    public function setStatus(mixed $value) : self
    {
        $this->setValue("status", $value);
        return $this;
    }

    /** @api */
    public function setPrio(int $value) : self
    {
        $this->setValue("prio", $value);
        return $this;
    }

    /** @api */
    public function setDescription(mixed $value) : self
    {
        $this->setValue("description", $value);
        return $this;
    }

    /** @api */
    public function setContent(mixed $value) : self
    {
        $this->setValue("content", $value);
        return $this;
    }

    /** @api */
    public function setImage(string $filename) : self
    {
        if(rex_media::get($filename)) {
            $this->getValue("image", $filename);
        }
        return $this;
    }

    /** @api */
    public function setCreatedate(string $value) : self
    {
        $this->setValue("createdate", $value);
        return $this;
    }

    /** @api */
    public function setUpdatedate(string $value) : self
    {
        $this->setValue("updatedate", $value);
        return $this;
    }

    /** @api */
    public function setCompany(mixed $value) : self
    {
        $this->setValue("company", $value);
        return $this;
    }

    /** @api */
    public function setFirstname(mixed $value) : self
    {
        $this->setValue("firstname", $value);
        return $this;
    }

    /** @api */
    public function setLastname(mixed $value) : self
    {
        $this->setValue("lastname", $value);
        return $this;
    }

    /** @api */
    public function setEmailWork(mixed $value) : self
    {
        $this->setValue("email_work", $value);
        return $this;
    }

    /** @api */
    public function setEmailHome(mixed $value) : self
    {
        $this->setValue("email_home", $value);
        return $this;
    }

    /** @api */
    public function setPhone(mixed $value) : self
    {
        $this->setValue("phone", $value);
        return $this;
    }

    /** @api */
    public function setPhoneWork(mixed $value) : self
    {
        $this->setValue("phone_work", $value);
        return $this;
    }

    /** @api */
    public function setPhoneHome(mixed $value) : self
    {
        $this->setValue("phone_home", $value);
        return $this;
    }
}
