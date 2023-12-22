# Staff - Mitarbeiter verwalten

Ein REDAXO-Addon für Listen von Mitarbeitenden, Ansprechpartner\*innen und Kontaktdaten für Teamseiten.

![staff_title](https://user-images.githubusercontent.com/3855487/183459112-aebbca72-6af5-427d-9536-db7e94e60792.png)

## Features

* Staff basiert vollkommen auf YForm. Nutze alle Vorteile, die YForm bietet mit der eigenen Dataset-Klasse:
* VCard-Library zum Erstellen von VCard-Dateien für Mitarbeitende
* QRCode-Library zum Erstellen von Kontaktdaten-QR-Codes

`staff:get($id)` - erhalte einen bestimmten Mitarbeitenden anhand der Datensatz-ID
`staff::query()->findAll()` erhalte eine Array aller Mitarbeitenden.

### Visitenkarte als VCard-Datei

```php
echo '<img src="'.staff::getQRCode($person).'">"';
```

Weitere Informationen beim Vendor <https://github.com/jeroendesloovere/vcard>

### Visitenkarte als QR-Code

```php
$person = staff::get($id);
echo staff::getVCard($person);
```

Weitere Informationen beim Vendor <https://github.com/chillerlan/php-qrcode>

### Weitere YOrm-Methoden

Alle weiteren Dataset-Methoden leiten sich von YOrm in YForm ab.
