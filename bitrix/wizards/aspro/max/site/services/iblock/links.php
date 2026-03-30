<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
if(!CModule::IncludeModule("iblock")) return;
if(!CModule::IncludeModule("aspro.max")) return;
if(!CModule::IncludeModule("catalog")) return;

if(!defined("WIZARD_SITE_ID")) return;
if(!defined("WIZARD_SITE_DIR")) return;
if(!defined("WIZARD_SITE_PATH")) return;
if(!defined("WIZARD_TEMPLATE_ID")) return;
if(!defined("WIZARD_TEMPLATE_ABSOLUTE_PATH")) return;
if(!defined("WIZARD_THEME_ID")) return;

$bitrixTemplateDir = $_SERVER["DOCUMENT_ROOT"].BX_PERSONAL_ROOT."/templates/".WIZARD_TEMPLATE_ID."/";


// iblocks ids
$add_reviewIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_add_review"][0];
$partnersIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_partners"][0];
$brandsIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_brands"][0];
$newsIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_news"][0];
$stockIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_stock"][0];
$servicesIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_services"][0];
$catalogIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_catalog"]["aspro_max_catalog"][0];
$projectsIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_projects"][0];
$staffIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_staff"][0];
$regionsIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_regionality"]["aspro_max_regions"][0];
$articlesIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_articles"][0];
$landingIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_catalog"]["aspro_max_landing"][0];
$searchIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_catalog"]["aspro_max_search"][0];
$cross_salesIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_catalog"]["aspro_max_cross_sales"][0];
$megamenuIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_catalog"]["aspro_max_megamenu"][0];
$tizersIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_content"]["aspro_max_tizers"][0];
$banners_innerIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_adv"]["aspro_max_banners_inner"][0];
$banners_catalogIBlockID = CMaxCache::$arIBlocks[WIZARD_SITE_ID]["aspro_max_adv"]["aspro_max_banners_catalog"][0];

// elements ids
$arBrands = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($brandsIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $brandsIBlockID), false, false, array("ID", "XML_ID"));
$arCatalog = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($catalogIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $catalogIBlockID), false, false, array("ID", "XML_ID"));
$arServices = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($servicesIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $servicesIBlockID), false, false, array("ID", "XML_ID"));
$arNews = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($newsIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $newsIBlockID), false, false, array("ID", "XML_ID"));
$arCatalog = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($catalogIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $catalogIBlockID), false, false, array("ID", "XML_ID"));
$arStaff = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($staffIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $staffIBlockID), false, false, array("ID", "XML_ID"));
$arAdd_review = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($add_reviewIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $add_reviewIBlockID), false, false, array("ID", "XML_ID"));
$arRegions = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($regionsIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $regionsIBlockID), false, false, array("ID", "XML_ID"));
$arPartners = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($partnersIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $partnersIBlockID), false, false, array("ID", "XML_ID"));
$arArticles = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($articlesIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $articlesIBlockID), false, false, array("ID", "XML_ID"));
$arSearch = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($searchIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $searchIBlockID), false, false, array("ID", "XML_ID"));
$arCross_sales = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($cross_salesIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $cross_salesIBlockID), false, false, array("ID", "XML_ID"));
$arStock = CMaxCache::CIBlockElement_GetList(array("CACHE" => array("TIME" => 0, "TAG" => CMaxCache::GetIBlockCacheTag($stockIBlockID), "GROUP" => array("XML_ID"), "RESULT" => array("ID"))), array("IBLOCK_ID" => $stockIBlockID), false, false, array("ID", "XML_ID"));



// update links in aspro_max_catalog
CIBlockElement::SetPropertyValuesEx($arCatalog["3978"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3979"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3980"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3981"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3982"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3983"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3984"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3985"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3986"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3987"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3988"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3989"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3990"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3991"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3992"], $catalogIBlockID, array("BRAND" => array($arBrands["3300"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3993"], $catalogIBlockID, array("BRAND" => array($arBrands["3303"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3860"], $catalogIBlockID, array("BRAND" => array($arBrands["454"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3861"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3862"], $catalogIBlockID, array("BRAND" => array($arBrands["454"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3863"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3893"], $catalogIBlockID, array("BRAND" => array($arBrands["454"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3894"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3895"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3896"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4026"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3853"], $catalogIBlockID, array("BRAND" => array($arBrands["454"]), "SERVICES" => array($arServices["3844"], $arServices["10629"]), "ASSOCIATED" => array($arCatalog["3859"], $arCatalog["3858"], $arCatalog["3857"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3857"], $catalogIBlockID, array("BRAND" => array($arBrands["832"]), "SERVICES" => array($arServices["3844"], $arServices["10629"]), "ASSOCIATED" => array($arCatalog["3853"], $arCatalog["3859"], $arCatalog["3858"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3858"], $catalogIBlockID, array("BRAND" => array($arBrands["454"]), "SERVICES" => array($arServices["3844"], $arServices["10629"]), "ASSOCIATED" => array($arCatalog["3859"], $arCatalog["3857"], $arCatalog["3853"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3859"], $catalogIBlockID, array("BRAND" => array($arBrands["832"]), "SERVICES" => array($arServices["3844"], $arServices["10629"]), "ASSOCIATED" => array($arCatalog["3857"], $arCatalog["3853"], $arCatalog["3858"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3868"], $catalogIBlockID, array("BRAND" => array($arBrands["401"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3869"], $catalogIBlockID, array("BRAND" => array($arBrands["401"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3873"], $catalogIBlockID, array("BRAND" => array($arBrands["401"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3879"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3880"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3881"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3882"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3883"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3884"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3885"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3886"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3887"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3888"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3889"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3890"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3891"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4017"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3897"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3898"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3899"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3900"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4027"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4028"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4029"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4030"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3901"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3902"], $catalogIBlockID, array("BRAND" => array($arBrands["49632"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3903"], $catalogIBlockID, array("BRAND" => array($arBrands["3356"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3904"], $catalogIBlockID, array("BRAND" => array($arBrands["49632"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3905"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3906"], $catalogIBlockID, array("BRAND" => array($arBrands["49632"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3907"], $catalogIBlockID, array("BRAND" => array($arBrands["3356"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3908"], $catalogIBlockID, array("BRAND" => array($arBrands["49632"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["fdf38118-41bc-11db-bff8-00030d2b3726"], $catalogIBlockID, array("BRAND" => array($arBrands["49632"]), "ASSOCIATED" => array($arCatalog["fdf3810c-41bc-11db-bff8-00030d2b3726"], $arCatalog["37eb861e-cb06-11e1-91a6-001cf08b4a3b"], $arCatalog["2bdcd9b4-f480-11e0-90e5-001cf08b4a3b"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["fdf3810c-41bc-11db-bff8-00030d2b3726"], $catalogIBlockID, array("BRAND" => array($arBrands["3356"]), "ASSOCIATED" => array($arCatalog["fdf38118-41bc-11db-bff8-00030d2b3726"], $arCatalog["37eb861e-cb06-11e1-91a6-001cf08b4a3b"], $arCatalog["2bdcd9b4-f480-11e0-90e5-001cf08b4a3b"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["37eb861e-cb06-11e1-91a6-001cf08b4a3b"], $catalogIBlockID, array("BRAND" => array($arBrands["3356"]), "ASSOCIATED" => array($arCatalog["2bdcd9b4-f480-11e0-90e5-001cf08b4a3b"], $arCatalog["fdf3810c-41bc-11db-bff8-00030d2b3726"], $arCatalog["fdf38118-41bc-11db-bff8-00030d2b3726"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["2bdcd9b4-f480-11e0-90e5-001cf08b4a3b"], $catalogIBlockID, array("LINK_NEWS" => array($arNews["10633"]), "BRAND" => array($arBrands["3356"]), "ASSOCIATED" => array($arCatalog["fdf3810c-41bc-11db-bff8-00030d2b3726"], $arCatalog["fdf38118-41bc-11db-bff8-00030d2b3726"], $arCatalog["37eb861e-cb06-11e1-91a6-001cf08b4a3b"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3909"], $catalogIBlockID, array("BRAND" => array($arBrands["49632"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3910"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3995"], $catalogIBlockID, array("BRAND" => array($arBrands["49632"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3913"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3914"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3915"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3916"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3949"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3950"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3951"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3952"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3917"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3921"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3927"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3944"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3953"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3954"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3997"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3998"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3962"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3963"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3999"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4000"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4002"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4003"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4090"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4091"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3966"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3970"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3971"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3972"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4001"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4004"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3974"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3975"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["3977"], $catalogIBlockID, array("BRAND" => array($arBrands["3305"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4005"], $catalogIBlockID, array("BRAND" => array($arBrands["3306"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4033"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4034"], $catalogIBlockID, array("BRAND" => array($arBrands["832"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4035"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));
CIBlockElement::SetPropertyValuesEx($arCatalog["4036"], $catalogIBlockID, array("BRAND" => array($arBrands["3302"])));

// update links in aspro_max_articles
CIBlockElement::SetPropertyValuesEx($arArticles["4031"], $articlesIBlockID, array("LINK_GOODS" => array($arCatalog["3880"], $arCatalog["3885"], $arCatalog["4017"], $arCatalog["3900"], $arCatalog["4029"])));
CIBlockElement::SetPropertyValuesEx($arArticles["3422"], $articlesIBlockID, array("LINK_GOODS" => array($arCatalog["3862"], $arCatalog["3863"], $arCatalog["3860"])));

// update links in aspro_max_add_review
CIBlockElement::SetPropertyValuesEx($arAdd_review["3653"], $add_reviewIBlockID, array("STAFF" => array($arStaff["75"])));

// update links in aspro_max_partners
CIBlockElement::SetPropertyValuesEx($arPartners["27"], $partnersIBlockID, array("LINK_REGION" => array($arRegions["3213"], $arRegions["3214"])));
CIBlockElement::SetPropertyValuesEx($arPartners["28"], $partnersIBlockID, array("LINK_REGION" => array($arRegions["3213"], $arRegions["3212"], $arRegions["3215"])));
CIBlockElement::SetPropertyValuesEx($arPartners["1762"], $partnersIBlockID, array("LINK_REGION" => array($arRegions["3213"], $arRegions["3212"], $arRegions["3215"], $arRegions["3214"])));
CIBlockElement::SetPropertyValuesEx($arPartners["67"], $partnersIBlockID, array("LINK_REGION" => array($arRegions["3213"], $arRegions["3212"], $arRegions["3215"])));
CIBlockElement::SetPropertyValuesEx($arPartners["69"], $partnersIBlockID, array("LINK_REGION" => array($arRegions["3213"], $arRegions["3212"], $arRegions["3215"], $arRegions["3214"])));
CIBlockElement::SetPropertyValuesEx($arPartners["70"], $partnersIBlockID, array("LINK_REGION" => array($arRegions["3212"], $arRegions["3215"], $arRegions["3214"])));


// get sections
$newPropSectionsXML = array (
  472 => '472',
  470 => '470',
  463 => '463',
  464 => '464',
  484 => '484',
  466 => '466',
  481 => '481',
  461 => '461',
  462 => '462',
  465 => '465',
  480 => '480',
  482 => '482',
  488 => '488',
  455 => '455',
  477 => '477',
  478 => '478',
  475 => '475',
  467 => '467',
  469 => '469',
  471 => '471',
  456 => '456',
  473 => '473',
  457 => '457',
  474 => '474',
  476 => '476',
  459 => '459',
  458 => '458',
  460 => '460',
);
$newPropSectionsRes = CIBlockSection::GetList(array(), array("XML_ID" => $newPropSectionsXML, "IBLOCK_ID" => $catalogIBlockID), false, array("ID", "XML_ID"));
while($newPropSection = $newPropSectionsRes->Fetch()) {
	$arNewPropSections[$newPropSection["XML_ID"]] = $newPropSection["ID"];
}

// get props
$newPropPropsXML = array (
);
foreach($newPropPropsXML as $xml) {
	$resNewProps = CIBlockProperty::GetList(
		array(),
		array("XML_ID" => $xml, "IBLOCK_ID" => $catalogIBlockID)
	);
	$newProp = $resNewProps->Fetch();
	$arNewPropProps[$newProp["XML_ID"]] = $newProp["ID"];
}

// update values custom filter
CIBlockElement::SetPropertyValuesEx($arCatalog["3882"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["472"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["470"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3979"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3853"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["464"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3916"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3963"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arServices["3844"], $servicesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3853,3857,3858,3859]}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3978"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3859"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["464"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3881"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["472"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["470"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3913"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3962"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3980"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3857"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["464"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3880"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["470"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["472"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3914"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3999"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3981"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3858"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["464"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3883"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["470"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["472"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3915"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4000"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3983"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3860"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["466"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3951"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4003"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arServices["10629"], $servicesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3853,3857,3858,3859,3880,3881,3882,3883,3885,3887,3890,3901,3902,3903,3906,3908,3909,3910,3913,3914,3915,3916,3917,3944,3949,3950,3951,3952,3962,3963,3978,3979,3980,3981,3982,3983,3984,3985,3990,3991,3994,3995,4002]}}]}'));
CIBlockElement::SetPropertyValuesEx($arArticles["10635"], $articlesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3881]}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3982"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3861"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["466"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3952"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4090"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arNews["4015"], $newsIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[2494,3018,3859,3860,3862,3882,3883]}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3984"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3862"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["466"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3949"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4091"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3985"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["463"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3863"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["466"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3950"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4002"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3987"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3894"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["465"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3890"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3891]}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3921"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["480"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3971"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["482"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arServices["3845"], $servicesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["488"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3986"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3893"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["465"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3917"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["480"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3970"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["482"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3988"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3895"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["466"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3927"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["480"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4004"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["482"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4026"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":{"1":{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3860,3861]}}}}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3989"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3891"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3890]}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3944"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["480"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3972"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["482"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3966"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4001"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3991"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3868"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["455"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3994"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3954"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3975"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arNews["4016"], $newsIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["477"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["478"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arServices["3847"], $servicesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["475"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3990"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3869"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["455"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3953"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3974"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["481"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3992"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3910"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3997"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3977"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["477"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3993"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3879"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["455"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3995"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["3998"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["484"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCatalog["4005"], $catalogIBlockID, array("EXPANDABLES_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["477"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arSearch["4039"], $searchIBlockID, array("CUSTOM_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["467"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["3996"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["470"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["469"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4006"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["471"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["456"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4007"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["472"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["456"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4008"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["473"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["457"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4009"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["474"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["457"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4010"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["476"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["457"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4022"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3988,3989]}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4023"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3986,3987]}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4024"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":{"1":{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3986,3987]}}}}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["462"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4025"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3988,3989]}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arCross_sales["4032"], $cross_salesIBlockID, array("PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["467"].'"}}]}', "EXT_PRODUCTS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":{"1":{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3860,3861,3869,3873,3879]}}}}'));
CIBlockElement::SetPropertyValuesEx($arStock["4011"], $stockIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["459"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arStock["4012"], $stockIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}},{"CLASS_ID":"CondIBElement","DATA":{"logic":"Equal","value":[3990]}}]}'));
CIBlockElement::SetPropertyValuesEx($arStock["4013"], $stockIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["465"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["466"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arServices["4092"], $servicesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"AND","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["461"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arArticles["268"], $articlesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["455"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["457"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["456"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["458"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["459"].'"}},{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["460"].'"}}]}'));
CIBlockElement::SetPropertyValuesEx($arArticles["280"], $articlesIBlockID, array("LINK_GOODS_FILTER" => '{"CLASS_ID":"CondGroup","DATA":{"All":"OR","True":"True"},"CHILDREN":[{"CLASS_ID":"CondIBSection","DATA":{"logic":"Equal","value":"'.$arNewPropSections["475"].'"}}]}'));

if($_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])
{
	$mxResult = CCatalogSKU::GetInfoByProductIBlock($_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"]);
	if(is_array($mxResult)){
		$skuIblockId = $mxResult['IBLOCK_ID'];
	}

	if($_SESSION["WIZARD_MAXIMUM_STOCK_IBLOCK_ID"])
	{
		$ibp = new CIBlockProperty;
		$arStockProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_STOCK_IBLOCK_ID"], "CODE" => "LINK_GOODS_FILTER"))->Fetch();
		if($arStockProps["ID"])
		{
			$ibp->Update($arStockProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp, $_SESSION["WIZARD_MAXIMUM_STOCK_IBLOCK_ID"]);
		}
	}

	if($_SESSION["WIZARD_MAXIMUM_ARTICLES_IBLOCK_ID"])
	{
		$ibp = new CIBlockProperty;
		$arArticlesProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_ARTICLES_IBLOCK_ID"], "CODE" => "LINK_GOODS_FILTER"))->Fetch();
		if($arArticlesProps["ID"])
		{
			$ibp->Update($arArticlesProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp, $_SESSION["WIZARD_MAXIMUM_ARTICLES_IBLOCK_ID"]);
		}
	}

	if($_SESSION["WIZARD_MAXIMUM_NEWS_IBLOCK_ID"])
	{
		$ibp = new CIBlockProperty;
		$arNewsProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_NEWS_IBLOCK_ID"], "CODE" => "LINK_GOODS_FILTER"))->Fetch();
		if($arNewsProps["ID"])
		{
			$ibp->Update($arNewsProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp, $_SESSION["WIZARD_MAXIMUM_NEWS_IBLOCK_ID"]);
		}
	}

	if($_SESSION["WIZARD_MAXIMUM_PROJECTS_IBLOCK_ID"])
	{
		$ibp = new CIBlockProperty;
		$arProjectsProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_PROJECTS_IBLOCK_ID"], "CODE" => "LINK_GOODS_FILTER"))->Fetch();
		if($arProjectsProps["ID"])
		{
			$ibp->Update($arProjectsProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp, $_SESSION["WIZARD_MAXIMUM_PROJECTS_IBLOCK_ID"]);
		}
	}

	if($_SESSION["WIZARD_MAXIMUM_CROSS_SALE_IBLOCK_ID"])
	{
		$ibp = new CIBlockProperty;
		$arCrossProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CROSS_SALE_IBLOCK_ID"], "CODE" => "PRODUCTS_FILTER"))->Fetch();
		if($arCrossProps["ID"])
		{
			$ibp->Update($arCrossProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$ibp = new CIBlockProperty;
		$arCrossProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CROSS_SALE_IBLOCK_ID"], "CODE" => "EXT_PRODUCTS_FILTER"))->Fetch();
		if($arCrossProps["ID"])
		{
			$ibp->Update($arCrossProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp, $_SESSION["WIZARD_MAXIMUM_CROSS_SALE_IBLOCK_ID"]);
		}
	}

	if($_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"])
	{
		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"], "CODE" => "CUSTOM_FILTER"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"], "CODE" => "I_ELEMENT_PAGE_TITLE"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"], "CODE" => "I_ELEMENT_PREVIEW_PICTURE_FILE_TITLE"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"], "CODE" => "I_ELEMENT_PREVIEW_PICTURE_FILE_ALT"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		if($skuIblockId){
			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"], "CODE" => "I_SKU_PAGE_TITLE"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}

			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"], "CODE" => "I_SKU_PREVIEW_PICTURE_FILE_TITLE"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}

			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"], "CODE" => "I_SKU_PREVIEW_PICTURE_FILE_ALT"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}
		}

		unset($_SESSION["WIZARD_MAXIMUM_SEARCH_IBLOCK_ID"]);
	}

	if($_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"])
	{
		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"], "CODE" => "I_ELEMENT_PAGE_TITLE"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"], "CODE" => "I_ELEMENT_PREVIEW_PICTURE_FILE_TITLE"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"], "CODE" => "I_ELEMENT_PREVIEW_PICTURE_FILE_ALT"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		if($skuIblockId){
			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"], "CODE" => "I_SKU_PAGE_TITLE"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}

			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"], "CODE" => "I_SKU_PREVIEW_PICTURE_FILE_TITLE"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}

			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"], "CODE" => "I_SKU_PREVIEW_PICTURE_FILE_ALT"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}
		}

		unset($_SESSION["WIZARD_MAXIMUM_CATALOG_INFO_IBLOCK_ID"]);
	}

	if($_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"])
	{
		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"], "CODE" => "FILTER_NEW"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproCustomFilterMax','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"], "CODE" => "I_ELEMENT_PAGE_TITLE"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"], "CODE" => "I_ELEMENT_PREVIEW_PICTURE_FILE_TITLE"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"], "CODE" => "I_ELEMENT_PREVIEW_PICTURE_FILE_ALT"))->Fetch();
		if($arSearchProps["ID"])
		{
			$ibp = new CIBlockProperty;
			$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"])));
			unset($ibp);
		}

		if($skuIblockId){
			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"], "CODE" => "I_SKU_PAGE_TITLE"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}

			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"], "CODE" => "I_SKU_PREVIEW_PICTURE_FILE_TITLE"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}

			$arSearchProps = CIBlockProperty::GetList(array(), array("IBLOCK_ID" => $_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"], "CODE" => "I_SKU_PREVIEW_PICTURE_FILE_ALT"))->Fetch();
			if($arSearchProps["ID"])
			{
				$ibp = new CIBlockProperty;
				$ibp->Update($arSearchProps["ID"], array('USER_TYPE' => 'SAsproMaxIBInherited','USER_TYPE_SETTINGS' => array('IBLOCK_ID' => $skuIblockId)));
				unset($ibp);
			}
		}

		unset($_SESSION["WIZARD_MAXIMUM_LANDING_IBLOCK_ID"]);
	}

	unset($_SESSION["WIZARD_MAXIMUM_CATALOG_IBLOCK_ID"]);
}

$UserFields = array(
	$catalogIBlockID => array(
		'UF_SECTION_DESCR',
		'UF_SECTION_TEMPLATE',
		'UF_TIZERS',
		'UF_POPULAR',
		'UF_CATALOG_ICON',
		'UF_OFFERS_TYPE',
		'UF_TABLE_SIZES',
		'UF_ELEMENT_DETAIL',
		'UF_SECTION_BG_IMG',
		'UF_SECTION_BG_DARK',
		'UF_SECTION_TIZERS' => array(
			'LINK_IBLOCK' => $tizersIBlockID,
		),
		'UF_HELP_TEXT',
		'UF_MENU_BANNER' => array(
			'LINK_IBLOCK' => $banners_innerIBlockID,
		),
		'UF_REGION' => array(
			'LINK_IBLOCK' => $regionsIBlockID,
		),
		'UF_PICTURE_RATIO',
		'UF_LINE_ELEMENT_CNT',
		'UF_LINKED_BLOG' => array(
			'LINK_IBLOCK' => $articlesIBlockID,
		),
		'UF_BLOG_WIDE',
		'UF_BLOG_BOTTOM',
		'UF_BLOG_MOBILE',
		'UF_MENU_BRANDS' => array(
			'LINK_IBLOCK' => $brandsIBlockID,
		),
		'UF_LINKED_BANNERS' => array(
			'LINK_IBLOCK' => $banners_catalogIBlockID,
		),
		'UF_BANNERS_WIDE',
		'UF_BANNERS_BOTTOM',
		'UF_BANNERS_MOBILE',
		'UF_TABLE_PROPS',
	),
	$megamenuIBlockID => array(
		"UF_MENU_LINK",
		"UF_MEGA_MENU_LINK",
		"UF_CATALOG_ICON",
	),
);

// iblock user fields
$langFile = $_SERVER['DOCUMENT_ROOT'].'/bitrix/wizards/aspro/max/site/services/iblock/lang/ru/links.php';
include($langFile);

foreach($UserFields as $iblockId => $fields) {
	foreach ($fields as $fieldKey => $fieldInfo) {

		$fieldCode = is_array($fieldInfo) ? $fieldKey : $fieldInfo;

		$arLangs = array(
			"EDIT_FORM_LABEL"   => array(
		        "ru"    => $MESS[$fieldCode],
		        "en"    => $fieldCode,
		    ),
		    "LIST_COLUMN_LABEL" => array(
		        "ru"    => $MESS[$fieldCode],
		        "en"    => $fieldCode,
		    )
		);

		if( isset($fieldInfo['LINK_IBLOCK']) ) {
			$arLangs['SETTINGS'] = array(
				'DISPLAY' => 'LIST',
				'LIST_HEIGHT' => '5',
				'IBLOCK_ID' => $fieldInfo['LINK_IBLOCK'],
			);
		}

		$arUserField = CUserTypeEntity::GetList(array(), array("ENTITY_ID" => "IBLOCK_".$iblockId."_SECTION", "FIELD_NAME" => $fieldCode))->Fetch();

		if($arUserField) {
			$ob = new CUserTypeEntity();
			$ob->Update($arUserField["ID"], $arLangs);
		}

	}
}
?>