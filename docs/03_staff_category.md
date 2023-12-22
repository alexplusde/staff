# Klasse `staff_category`

Diese Klasse erweitert `rex_yform_manager_dataset` und stellt Methoden zur Verfügung, um auf die Daten einer bestimmten Mitarbeiterkategorie zuzugreifen.

> Es werden nachfolgend zur die durch dieses Addon ergänzte Methoden beschrieben. Lerne mehr über YOrm und den Methoden für Querys, Datasets und Collections in der [YOrm Doku](https://github.com/yakamara/yform/blob/master/docs/04_yorm.md)

## Methoden

### `getName()`

Gibt den Namen der Mitarbeiterkategorie zurück.

```php
$category = staff_category::get(1);
echo $category->getName(); // Gibt den Namen der Kategorie aus.
```

### `setName()`

Setzt den Namen der Mitarbeiterkategorie.

```php
$category = staff_category::create();
$category->setName("Neuer Name");
$category->save();
```
