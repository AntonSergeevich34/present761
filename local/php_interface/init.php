<?
use Bitrix\Main\Loader;
CModule::IncludeModule("iblock");
CModule::IncludeModule("catalog");

include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");

if (Loader::includeModule('iw.main')) {
	$iwEventManager = new \Iw\Events\EventManager();
	$iwEventManager->initEvents();
}

AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnAfterIBlockElementUpdateHandler");
function OnAfterIBlockElementUpdateHandler(&$arFields){
	
	$product = CIBlockElement::GetList([], ["IBLOCK_ID" => "21", "ID" => $arFields["ID"]], false, false, ["PROPERTY_FILES"]);
	while($ob = $product->GetNextElement())
	{
		$arProps = $ob->GetFields();

		if (!empty($arProps["PROPERTY_FILES_VALUE"])) {
			CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array('POPUP_VIDEO' => CFile::GetPath($arProps["PROPERTY_FILES_VALUE"])));
		}
		
	}

}

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('yandex.market', 'onExportOfferWriteData', function (\Bitrix\Main\Event $event) 
{
    Loader::includeModule('catalog');
    // @var $tagResultList Market\Result\XmlNode[] */
    // @var $tagElement \SimpleXMLElement */

    $tagResultList = $event->getParameter('TAG_RESULT_LIST');
    $context = $event->getParameter('CONTEXT');

    foreach ($tagResultList as $elementId => $tagResult) {
        if ($tagResult->isSuccess()) {
            $tagNode = $tagResult->getXmlElement();
            
            // $attributeList = $tagNode->attributes();

            if ($context["SETUP_ID"] == 5) {
                if ($tagNode->price < 500) {
	            	$tagNode->price = 500;
	            }
            }
            
        }
    }
});

/*
function updateProiskhozhdenieProperty (&$arFields) {
	$CATALOG_ID = 21;

	$brandList = Array(
		'Dr.Koffer New York'=>'СОЕДИНЕННЫЕ ШТАТЫ',
		'Zippo' => 'СОЕДИНЕННЫЕ ШТАТЫ',
		'Tri Slona' => 'ЯПОНИЯ',
		'Victorinox' => 'ШВЕЙЦАРИЯ',
		'Tony Perotti' => 'ИТАЛИЯ',
		'Wenger' => 'ШВЕЙЦАРИЯ',
		'S.Quire' => 'ИТАЛИЯ',
		'Pierre Cardin' => 'ФРАНЦИЯ',
		'Parker' => 'ВЕЛИКОБРИТАНИЯ',
		'Joy Bells' => 'ЮЖНАЯ КОРЕЯ',
		'Waterman' => 'ФРАНЦИЯ',
		'Навигатор' => 'РОССИЯ',
		'Sevaro Elit' => 'ИТАЛИЯ',
		'Tosoco' => 'КИТАЙ',
		'товары из натурального оникса' => 'ПАКИСТАН',
		'Solingen' => 'ГЕРМАНИЯ',
		'Свечи' => 'РОССИЯ',
		'СомС' => 'РОССИЯ',
		'Орбита' => 'РОССИЯ',
		'Caterpillar' => 'СОЕДИНЕННЫЕ ШТАТЫ',
		'Fulton' => 'ВЕЛИКОБРИТАНИЯ',
		'Янтарь+Бронза' => 'РОССИЯ',
		'SWISSGEAR' => 'ШВЕЙЦАРИЯ',
		'Mario Pilli' => 'ИТАЛИЯ',
		'Klondike' => 'ГЕРМАНИЯ',
		'Jardin D`Ete' => 'ФРАНЦИЯ',
		'IT' => 'ВЕЛИКОБРИТАНИЯ',
		'Henry Backer (London)' => 'ВЕЛИКОБРИТАНИЯ',
		'Giorgio Ferretti' => 'ИТАЛИЯ',
		'GD маникюрные наборы' => 'ГЕРМАНИЯ',
		'Dor.Flinger' => 'ГЕРМАНИЯ',
		'Dierhoff' => 'ГЕРМАНИЯ',
		'MONDIAL' => 'ИТАЛИЯ',
		'HAUSER' => 'ГЕРМАНИЯ',
		'Bruno Perri' => 'ИТАЛИЯ',
		'SV'=>'КИТАЙ'
	);

	$arSelect = Array("ID", "NAME", "PROPERTY_BRAND", 'PROPERTY_BRAND.NAME', "PROPERTY_PROISKHOZHDENIE");
	$arFilter = Array("IBLOCK_ID" => $CATALOG_ID, "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
	$usluga = "Услуга";

	while ($ob = $res->GetNextElement()) {
		$arFields = $ob->GetFields();

		$brandName = $brandList[$arFields['PROPERTY_BRAND_NAME']];
		if (empty($brandName) && stripos($usluga, $arFields['NAME'])=== false) {
			$brandName = 'КИТАЙ';
		}

		$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$CATALOG_ID, "CODE"=>"PROISKHOZHDENIE", 'VALUE'=>$brandName));

		if ($enum_fields = $property_enums->GetNext()) {
			CIBlockElement::SetPropertyValuesEx($arFields["ID"], false, array("PROISKHOZHDENIE" => $enum_fields["ID"]));
		}
	}
}

AddEventHandler("catalog", "OnCompleteCatalogImport1C", "updateProiskhozhdenieProperty");
*/
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "UpdateBrandOnProductSave");
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "UpdateBrandOnProductSave");

function UpdateBrandOnProductSave(&$arFields)
{
    // === НАСТРОЙКИ ===
    $CATALOG_IBLOCK_ID = 21; 
    $BRAND_IBLOCK_ID = 29;   
    $PROP_MANUFACTURER_CODE = "CML2_MANUFACTURER"; // Строковое св-во (откуда берем имя)
    $PROP_BRAND_CODE = "BRAND"; // Свойство привязки к элементу (куда пишем ID бренда)
    // =================

    // Проверки контекста выполнения
    if ($arFields["IBLOCK_ID"] != $CATALOG_IBLOCK_ID) return;
    if (isset($arFields["RESULT"]) && $arFields["RESULT"] === false) return;
    
    // Дополнительная проверка для предотвращения ошибок
    if (!is_array($arFields)) {
        return;
    }

    $elementID = $arFields["ID"];

    // Статическая переменная для кэширования в рамках одного хита (полезно при импорте)
    static $brandsCache = []; 

    // Получаем данные текущего товара (нам нужно значение производителя)
    $rsElement = CIBlockElement::GetList(
        [], 
        ["IBLOCK_ID" => $CATALOG_IBLOCK_ID, "ID" => $elementID], 
        false, 
        false, 
        ["ID", "PROPERTY_".$PROP_MANUFACTURER_CODE]
    );

    if ($elementData = $rsElement->Fetch()) {
        $brandName = trim($elementData["PROPERTY_".$PROP_MANUFACTURER_CODE."_VALUE"]);
        $brandXmlId = $elementData["PROPERTY_".$PROP_MANUFACTURER_CODE."_VALUE_XML_ID"];

        if (!$brandName) return;

        $cacheKey = $brandXmlId ? $brandXmlId : "NAME_".md5($brandName);

        // 1. ПОИСК ИЛИ СОЗДАНИЕ БРЕНДА
        if (isset($brandsCache[$cacheKey])) {
            $brandElementId = $brandsCache[$cacheKey];
        } else {
            $brandElementId = 0;

            // Поиск по XML_ID
            if ($brandXmlId) {
                $dbrp = CIBlockElement::GetList([], ["IBLOCK_ID" => $BRAND_IBLOCK_ID, "=XML_ID" => $brandXmlId], false, false, ["ID"]);
                if ($row = $dbrp->Fetch()) {
                    $brandElementId = $row["ID"];
                }
            }

            // Поиск по Имени
            if (!$brandElementId) {
                $dbrpByName = CIBlockElement::GetList([], ["IBLOCK_ID" => $BRAND_IBLOCK_ID, "=NAME" => $brandName], false, false, ["ID"]);
                if ($row = $dbrpByName->Fetch()) {
                    $brandElementId = $row["ID"];
                }
            }

            // Создание нового бренда
            if (!$brandElementId) {
                $el = new CIBlockElement;
                
                $code = CUtil::translit($brandName, "ru", ["replace_space"=>"-", "replace_other"=>"-"]);
                
                // Проверка уникальности кода
                $checkCode = CIBlockElement::GetList([], ["IBLOCK_ID" => $BRAND_IBLOCK_ID, "=CODE" => $code], false, false, ["ID"]);
                if($checkCode->Fetch()) {
                     $code .= "-" . time();
                }
                
                $newXmlId = $brandXmlId ? $brandXmlId : md5($brandName);

                $newBrandFields = [
                    'IBLOCK_ID' => $BRAND_IBLOCK_ID,
                    'NAME'      => $brandName,
                    'ACTIVE'    => "Y", // Новый бренд сразу активен
                    'XML_ID'    => $newXmlId,
                    'CODE'      => $code
                ];
                $brandElementId = $el->Add($newBrandFields);
            }

            if ($brandElementId) {
                $brandsCache[$cacheKey] = $brandElementId;
            }
        }

        // 2. ОБНОВЛЕНИЕ ТОВАРА И АКТИВАЦИЯ БРЕНДА
        if ($brandElementId) {
            // Привязываем товар к бренду
            CIBlockElement::SetPropertyValuesEx(
                $elementID, 
                $CATALOG_IBLOCK_ID, 
                [$PROP_BRAND_CODE => $brandElementId]
            );

            // === ДОБАВЛЕННАЯ ЛОГИКА АКТИВАЦИИ ===
            
            // Получаем текущий статус бренда
            $rsBrand = CIBlockElement::GetList(
                [], 
                ["IBLOCK_ID" => $BRAND_IBLOCK_ID, "ID" => $brandElementId], 
                false, 
                false, 
                ["ID", "ACTIVE"]
            );
            
            if ($arBrand = $rsBrand->Fetch()) {
                // Если бренд НЕ активен, проверяем, есть ли у него активные товары
                if ($arBrand['ACTIVE'] != 'Y') {
                    
                    // Ищем хотя бы ОДИН активный товар с этим брендом
                    $rsActiveProducts = CIBlockElement::GetList(
                        [],
                        [
                            "IBLOCK_ID" => $CATALOG_IBLOCK_ID,
                            "ACTIVE" => "Y",
                            "PROPERTY_".$PROP_BRAND_CODE => $brandElementId
                        ],
                        false,
                        ["nTopCount" => 1], // Нам достаточно одного
                        ["ID"]
                    );

                    // Если активные товары найдены — активируем бренд
                    if ($rsActiveProducts->Fetch()) {
                        $elBrand = new CIBlockElement;
                        $elBrand->Update($brandElementId, ["ACTIVE" => "Y"]);
                    }
                }
            }
            // ====================================
        }
    }
}