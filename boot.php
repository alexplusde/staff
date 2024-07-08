<?php

if (rex_addon::get('yform')->isAvailable() && !rex::isSafeMode()) {
    rex_yform_manager_dataset::setModelClass(
        'rex_staff',
        staff::class,
    );
    rex_yform_manager_dataset::setModelClass(
        'rex_staff_category',
        staff_category::class,
    );
}

if (rex::isBackend() && 'staff/edit' == rex_be_controller::getCurrentPage() || 'yform/manager/data_edit' == rex_be_controller::getCurrentPage()) {
    rex_extension::register('OUTPUT_FILTER', static function (rex_extension_point $ep) {
        $suchmuster = 'class="###staff-settings-editor###"';
        $ersetzen = rex_config::get('staff', 'editor');
        $ep->setSubject(str_replace($suchmuster, $ersetzen, $ep->getSubject()));
    });
}

if (rex::isBackend()) {
    $addon = rex_addon::get('staff');
    $page = $addon->getProperty('page');

    $_csrf_key = rex_yform_manager_table::get('rex_staff')->getCSRFKey();
    $token = rex_csrf_token::factory($_csrf_key)->getUrlParams();

    $params = [];
    $params['table_name'] = 'rex_staff'; // Tabellenname anpassen
    $params['rex_yform_manager_popup'] = '0';
    $params['_csrf_token'] = $token['_csrf_token'];
    $params['func'] = 'add';

    $page['title'] .= ' <a style="position: absolute; top: 0; right: 0; padding: 5px; margin: 8px 19px 8px 8px" href="' . rex_url::backendPage('staff/person', $params) . '" class="label label-default pull-right">+</a>';
    $addon->setProperty('page', $page);
}
