<?
// aspro.smartseo 1.0.6 updater
// changed files
// /admin/views/filter_rule_detail/grids/grid_filter_rule_sitemap.php - update
// /admin/views/filter_rule_detail/grids/grid_filter_rule_tags.php - update
// /admin/views/filter_rule_detail/grids/grid_filter_rule_urls.php - update
// /classes/admin/controllers/FilterSearchController.php - update
// /classes/admin/controllers/FilterSitemapController.php - update
// /classes/admin/controllers/FilterTagController.php - update
// /classes/admin/controllers/FilterUrlController.php - update
// /lang/en/admin/views/filter_rule_detail/grids/grid_filter_rule_conditions.php - update
// /lang/en/admin/views/filter_search/detail.php - update
// /lang/en/admin/views/filter_sitemap/detail.php - update
// /lang/en/admin/views/filter_tag/detail.php - update
// /lib/generator/handlers/PropertyUrlHandler.php - update

// module:

// css:

// js:
// /src/menu_inner_grid.js - update

// components:

// wizard:


// template:
// 

// public:
// 



use \Bitrix\Main\Config\Option;

require_once __DIR__ . '/functions.php';

define('PARTNER_NAME', 'aspro');
define('MODULE_NAME', 'aspro.smartseo');
define('MODULE_NAME_SHORT', 'smartseo');
define('TEMPLATE_NAME', 'aspro_smartseo');
define('MODULE_PATH', '/bitrix/modules/' . MODULE_NAME);
define('COMPONENT_PATH', '/bitrix/components/' . PARTNER_NAME);
define('ADMIN_JS_PATH', '/bitrix/js/' . MODULE_NAME);
define('ADMIN_CSS_PATH', '/bitrix/css/' . MODULE_NAME);
define('TEMPLATE_PATH', '/bitrix/templates/' . TEMPLATE_NAME);
define('UPDATER_SELF_TEMPLATE_PATH', 'install/wizards/' . PARTNER_NAME . '/' . MODULE_NAME_SHORT . '/site/templates/' . TEMPLATE_NAME);
define('UPDATER_SITE_TEMPLATE_PATH', 'templates/' . TEMPLATE_NAME);
define('CURRENT_VERSION', GetCurVersion($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/' . MODULE_NAME . '/install/version.php'));
define('NEW_VERSION', GetCurVersion(__DIR__ . '/install/version.php'));

UpdaterLog('START UPDATE ' . CURRENT_VERSION . ' -> ' . NEW_VERSION . PHP_EOL);


// remove old bak files
RemoveOldBakFiles();

// create bak files
foreach ([
	// module
	MODULE_PATH.'/admin/views/filter_rule_detail/grids/grid_filter_rule_sitemap.php',
	MODULE_PATH.'/admin/views/filter_rule_detail/grids/grid_filter_rule_tags.php',
	MODULE_PATH.'/admin/views/filter_rule_detail/grids/grid_filter_rule_urls.php',
	MODULE_PATH.'/classes/admin/controllers/FilterSearchController.php',
	MODULE_PATH.'/classes/admin/controllers/FilterSitemapController.php',
	MODULE_PATH.'/classes/admin/controllers/FilterTagController.php',
	MODULE_PATH.'/classes/admin/controllers/FilterUrlController.php',
	MODULE_PATH.'/lang/en/admin/views/filter_rule_detail/grids/grid_filter_rule_conditions.php',
	MODULE_PATH.'/lang/en/admin/views/filter_search/detail.php',
	MODULE_PATH.'/lang/en/admin/views/filter_sitemap/detail.php',
	MODULE_PATH.'/lang/en/admin/views/filter_tag/detail.php',
	MODULE_PATH.'/lib/generator/handlers/PropertyUrlHandler.php',

	//js
	ADMIN_JS_PATH.'/src/menu_inner_grid.js'
] as $file) {
	CreateBakFile($_SERVER['DOCUMENT_ROOT'] . $file);
}

//UpdaterLog('TEMPLATE_PATH ' . TEMPLATE_PATH);

// update module
//$updater->CopyFiles('install', 'modules/' . MODULE_NAME . '/install');

// update admin section images
//$updater->CopyFiles('install/images', 'images/'.MODULE_NAME);

// update admin section gadget
// $updater->CopyFiles('install/gadgets', 'gadgets');

// update admin page
// $updater->CopyFiles('install/admin', 'admin');

// update admin js
//$updater->CopyFiles('install/js', 'js/'.MODULE_NAME.'/');
CopyDirFiles(__DIR__ . '/install/js', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/js/'.MODULE_NAME.'/', true, true);

// update admin css
//$updater->CopyFiles('install/css', 'css/' . MODULE_NAME . '/');
// CopyDirFiles(__DIR__ . '/install/css', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/css/'.MODULE_NAME.'/', true, true);

// update admin tools
// $updater->CopyFiles('install/tools', 'tools/'.MODULE_NAME.'/');

// update wizard
//$updater->CopyFiles('install/wizards', 'wizards');

// update components
// if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/' . PARTNER_NAME . '/')) {
// 	// $updater->CopyFiles('install/components', 'components');
// 	CopyDirFiles(__DIR__ . '/install/components', $_SERVER['DOCUMENT_ROOT'] . '/bitrix/components/', true, true);
// }


// current SITEs
// $arSites = GetSites();

// current IBLOCK_IDs
// $arIblocks = GetIBlocks();


// if (IsModuleInstalled(MODULE_NAME)) {
// 	UnRegisterModuleDependences("iblock", "OnAfterIBlockElementDelete", MODULE_NAME, "CMaxCache", "DoIBlockElementAfterDelete");
// }

// is composite enabled
// $compositeMode = IsCompositeEnabled();

// clear all sites cache in some components and dirs (include composite cache)
// ClearAllSitesCacheDirs([
// 	'html_pages',
// 	'cache/js',
// 	'cache/css'
// ]);

// ClearAllSitesCacheComponents([
// 	// PARTNER_NAME.':catalog.delivery.max',
// 	// 'bitrix:catalog.element',
// ]);

// if ($compositeMode) {
// 	$arHTMLCacheOptions = GetCompositeOptions();
// 	EnableComposite($compositeMode === 'AUTO_COMPOSITE', $arHTMLCacheOptions);
// }

UpdaterLog('FINISH UPDATE ' . CURRENT_VERSION . ' -> ' . NEW_VERSION . PHP_EOL);
