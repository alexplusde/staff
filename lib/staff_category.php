<?php
/**
 * Klasse staff_category.
 *
 * Diese Klasse erweitert rex_yform_manager_dataset und stellt Methoden zur Verfügung,
 * um auf die Daten einer bestimmten Mitarbeiterkategorie zuzugreifen.
 */
class staff_category extends \rex_yform_manager_dataset
{
    /**
     * Gibt den Namen der Mitarbeiterkategorie zurück.
     *
     * @return string Der Name der Mitarbeiterkategorie.
     *
     * @example
     * $category = new staff_category();
     * echo $category->getName(); // Gibt den Namen der Kategorie aus.
     */
    public function getName(): string
    {
        return $this->getValue('name');
    }
    
    public function setName($name): self
    {
        $this->setValue('name', $name);
        return $this;
    }

    /**
     * Gibt alle Mitglieder der Mitarbeiterkategorie zurück.
     *
     * @return rex_yform_manager_collection|null Eine Sammlung von Mitarbeitern, die zur Kategorie gehören, oder null, wenn keine gefunden wurden.
     *
     * @example
     * $category = new staff_category();
     * $members = $category->getAllMembers();
     * foreach ($members as $member) {
     *     echo $member->getName(); // Gibt den Namen jedes Mitglieds aus.
     * }
     */
    public function getAllMembers(): ?rex_yform_manager_collection
    {
        return staff::query()->where('status', 0, '>')->whereListContains('category_ids', $this->id)
            ->find();
        return $this->getValue('name');
    }
}
