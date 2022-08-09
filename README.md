# Staff - Mitarbeiter verwalten

Ein REDAXO-Addon für Listen von Mitarbeitenden, Ansprechpartner\*innen und Kontaktdaten für Teamseiten.

![staff_title](https://user-images.githubusercontent.com/3855487/183459112-aebbca72-6af5-427d-9536-db7e94e60792.png)

## Features

* Staff basiert vollkommen auf YForm. Nutze alle Vorteile, die YForm bietet mit der eigenen Dataset-Klasse:
* VCard-Library zum Erstellen von VCard-Dateien für Mitarbeitende
* QRCode-Library zum Erstellen von Kontaktdaten-QR-Codes

`staff:get($id)` - erhalte einen bestimmten Mitarbeitenden anhand der Datensatz-ID
`staff::query()->findAll()` erhalte eine Array aller Mitarbeitenden.

### Weitere Methoden für den Datensatz

```php
$person = staff::get($id);

// Angaben zur Person, bspw. für eine Team-Seite
echo $person->getName();
echo $person->getDescription(); // z.B. Kurzbeschreibung
echo $person->getContent(); // z.B. Vita
echo $person->getImage(); // Medienpool-Dateiname

// Visitenkarte
echo $person->getTitle(); // z.B. `Dr.`
echo $person->getFirstName();
echo $person->getLastName();

echo $person->getCompany();

echo $person->getStreet();
echo $person->getZip();
echo $person->getCity();
echo $person->getCountry();

echo $person->getMailWork();
echo $person->getMailHome();
echo $person->getUrl(); // z.B: Unternehmenswebsite

echo $person->getPhone();
echo $person->getPhoneWork();
echo $person->getPhoneMail();
```

### Visitenkarte als VCard-Datei

```php
echo '<img src="'.staff::getQRCode($person).'">"';
```

Weitere Informationen beim Vendor https://github.com/jeroendesloovere/vcard

### Visitenkarte als QR-Code 

```php
$person = staff::get($id);
echo staff::getVCard($person);
```

Weitere Informationen beim Vendor https://github.com/chillerlan/php-qrcode

### Weitere YOrm-Methoden

Alle weiteren Dataset-Methoden leiten sich von YOrm in YForm ab.

## Lizenz

MIT Lizenz, siehe [LICENSE.md](https://github.com/alexplusde/staff/blob/master/LICENSE.md)  

## Autoren

**Alexander Walther**  
http://www.alexplus.de  
https://github.com/alexplusde  

**Projekt-Lead**  
[Alexander Walther](https://github.com/alexplusde)
