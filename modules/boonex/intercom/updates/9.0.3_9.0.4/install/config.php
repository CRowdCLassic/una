<?php
/**
 * Copyright (c) UNA, Inc - https://una.io
 * MIT License - https://opensource.org/licenses/MIT
 */

$aConfig = array(
    /**
     * Main Section.
     */
    'title' => 'Intercom',
    'version_from' => '9.0.3',
	'version_to' => '9.0.4',
    'vendor' => 'BoonEx',

    'compatible_with' => array(
        '9.0.0-RC9'
    ),

    /**
     * 'home_dir' and 'home_uri' - should be unique. Don't use spaces in 'home_uri' and the other special chars.
     */
    'home_dir' => 'boonex/intercom/updates/update_9.0.3_9.0.4/',
	'home_uri' => 'intercom_update_903_904',

	'module_dir' => 'boonex/intercom/',
	'module_uri' => 'intercom',

    'db_prefix' => 'bx_intercom_',
    'class_prefix' => 'BxIntercom',

    /**
     * Installation/Uninstallation Section.
     */
    'install' => array(
		'execute_sql' => 0,
        'update_files' => 1,
        'update_languages' => 0,
		'clear_db_cache' => 0,
    ),

	/**
     * Category for language keys.
     */
    'language_category' => 'Intercom',

	/**
     * Files Section
     */
    'delete_files' => array(),
);
