<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$module_id = "ipol.ozon";
\Bitrix\Main\Loader::includeModule($module_id);

\Ipol\Ozon\SubscribeHandler::getAjaxAction($_REQUEST['IPOL_OZON_action']);