# Klasse: `staff`

Die Klasse Staff ist ein Dataset für den YOrm Manager in REDAXO. Sie stellt Methoden zur Verfügung, um auf die Daten eines bestimmten Mitarbeiters zuzugreifen.

> Es werden nachfolgend zur die durch dieses Addon ergänzte Methoden beschrieben. Lerne mehr über YOrm und den Methoden für Querys, Datasets und Collections in der [YOrm Doku](https://github.com/yakamara/yform/blob/master/docs/04_yorm.md)

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

## Methoden

### `getQRCode()`

Erzeugt einen QR-Code für die vCard des Mitarbeiters.

### `getVCard()`

Erzeugt eine vCard für den Mitarbeiter.

### `getName()`

Gibt den vollständigen Namen des Mitarbeiters zurück.

### `getDescription()`

Gibt die Beschreibung des Mitarbeiters zurück.

### `getContent()`

Gibt den Inhalt des Mitarbeiters zurück.

### `getFirstName()`

Gibt den Vornamen des Mitarbeiters zurück.

### `getLastName()`

Gibt den Nachnamen des Mitarbeiters zurück.

### `getFullName()`

Gibt den vollständigen Namen des Mitarbeiters zurück. Wenn kein Vorname vorhanden ist, wird nur der Nachname zurückgegeben.

### `getTitle()`

Gibt den Titel des Mitarbeiters zurück.

### `getCompany()`

Gibt den Namen des Unternehmens des Mitarbeiters zurück. Wenn kein Unternehmensname vorhanden ist, wird der Standardunternehmensname aus der Konfiguration zurückgegeben.

### `getMailWork()`

Gibt die berufliche E-Mail-Adresse des Mitarbeiters zurück.

### `getMailHome()`

Gibt die private E-Mail-Adresse des Mitarbeiters zurück.

### `getStreet()`

Gibt die Straße der Adresse des Mitarbeiters zurück.

### `getCity()`

Gibt die Stadt der Adresse des Mitarbeiters zurück.

### `getZip()`

Gibt die Postleitzahl der Adresse des Mitarbeiters zurück.

### `getCountry()`

Gibt das Land der Adresse des Mitarbeiters zurück.

### `getUrl()`

Gibt die URL des Unternehmens des Mitarbeiters zurück. Wenn keine Unternehmens-URL vorhanden ist, wird die Standard-Unternehmens-URL aus der Konfiguration zurückgegeben.

### `getPhoneCell()`

Gibt die Mobiltelefonnummer des Mitarbeiters zurück.

### `getPhoneWork()`

Gibt die berufliche Telefonnummer des Mitarbeiters zurück.

### `getPhoneHome()`

Gibt die private Telefonnummer des Mitarbeiters zurück.

### `getImage()`

Gibt das Bild des Mitarbeiters zurück.

### `getMedia()`

Gibt das Medienobjekt des Mitarbeiters zurück.

### `normalizePhone()`

Normalisiert die Telefonnummer des Mitarbeiters.
