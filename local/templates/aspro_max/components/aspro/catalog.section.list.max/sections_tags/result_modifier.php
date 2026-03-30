<?
define("CATALOG_IBLOCK_ID", 21);
$currentBrandId = $arParams["FILTER_ELEMENTS_CNT"]["PROPERTY_BRAND"];

$arSelect = Array("ID", "IBLOCK_SECTION_ID");
$arFilter = Array("IBLOCK_ID"=>CATALOG_IBLOCK_ID, ">QUANTITY"=>0, "PROPERTY_BRAND"=>$currentBrandId, "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

$sectionContent = [];
while ($ob = $res->GetNext()) {
	$sectionContent[$ob["IBLOCK_SECTION_ID"]][] = $ob;
}

$sectionElementsCount = [];
foreach ($sectionContent as $id=>$item) {
	$sectionElementsCount[$id] = count($item);
}

$arResult['SECTION_ELEMENTS_COUNT'] = $sectionElementsCount;