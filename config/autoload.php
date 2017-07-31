<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2017 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'postyou',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'postyou\FbConnector'                 => 'system/modules/contao-facebook-connector_basic/classes/FbConnector.php',
	'postyou\FbConnectorModelFactory'     => 'system/modules/contao-facebook-connector_basic/classes/FbConnectorModelFactory.php',
	'postyou\ConnectionType'              => 'system/modules/contao-facebook-connector_basic/classes/ConnectionType.php',
	'postyou\FbConnectorHelper'           => 'system/modules/contao-facebook-connector_basic/classes/FbConnectorHelper.php',
	'postyou\FbCronDispatcher'            => 'system/modules/contao-facebook-connector_basic/classes/FbCronDispatcher.php',
	'postyou\FbConnectorPostGet'          => 'system/modules/contao-facebook-connector_basic/classes/FbConnectorPostGet.php',
	'postyou\FbBackendWrapperBasic'       => 'system/modules/contao-facebook-connector_basic/classes/FbBackendWrapperBasic.php',
	'postyou\ContaoPersistentDataHandler' => 'system/modules/contao-facebook-connector_basic/classes/ContaoPersistentDataHandler.php',

	// Models
	'postyou\FacebookPostsModel'          => 'system/modules/contao-facebook-connector_basic/models/FacebookPostsModel.php',
	'postyou\FacebookSitesModel'          => 'system/modules/contao-facebook-connector_basic/models/FacebookSitesModel.php',

	// Hooks
	'postyou\BackendAjaxHook'             => 'system/modules/contao-facebook-connector_basic/hooks/BackendAjaxHook.php',

	// Elements
	'postyou\FacebookPostList'            => 'system/modules/contao-facebook-connector_basic/elements/FacebookPostList.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'ce_facebook_posts'  => 'system/modules/contao-facebook-connector_basic/templates',
	'mod_facebook_posts' => 'system/modules/contao-facebook-connector_basic/templates',
));
