<?php
/* Tablesets aktualisieren */

rex_yform_manager_table_api::importTablesets(rex_file::get(rex_path::addon($this->name, 'install/rex_staff.tableset.json')));

rex_yform_manager_table::deleteCache();
