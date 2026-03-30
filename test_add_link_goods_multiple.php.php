<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    die("Ошибка подключения модуля 'iblock'.");
}


/*




$IBLOCK_SERVICES = 24; // Инфоблок "Услуги"
$IBLOCK_CATALOG = 21;  // Инфоблок "Каталог"
$SERVICE_ID = 17486;   // ID услуги
$SECTIONS = [372, 371, 370]; // ID разделов, из которых нужно привязать товары
$PROPERTY_CODE = 'LINK_GOODS'; // Код свойства, где хранится привязка

// Получение текущих привязанных элементов
$currentLinkedItems = [];
$res = CIBlockElement::GetProperty($IBLOCK_SERVICES, $SERVICE_ID, [], ['CODE' => $PROPERTY_CODE]);
while ($prop = $res->Fetch()) {
    if ($prop['VALUE']) {
        $currentLinkedItems[] = $prop['VALUE'];
    }
}

// Получение ID новых элементов из указанных разделов
$newItems = [];
$elements = \Bitrix\Iblock\Elements\ElementCatalogTable::getList([
    'filter' => [
        'IBLOCK_ID' => $IBLOCK_CATALOG,
        'IBLOCK_SECTION_ID' => $SECTIONS,
        'ACTIVE' => 'Y'
    ],
    'select' => ['ID'],
]);
while ($element = $elements->fetch()) {
    // Добавляем только новые элементы, которые ещё не привязаны
    if (!in_array($element['ID'], $currentLinkedItems)) {
        $newItems[] = $element['ID'];
    }
}

// Если есть новые элементы, добавляем их к текущим привязкам
if (!empty($newItems)) {
    $updatedLinkedItems = array_merge($currentLinkedItems, $newItems);

    // Сохраняем обновленный список привязок
    CIBlockElement::SetPropertyValuesEx($SERVICE_ID, $IBLOCK_SERVICES, [
        $PROPERTY_CODE => $updatedLinkedItems
    ]);

    echo "Новые элементы (" . implode(', ', $newItems) . ") успешно добавлены к услуге с ID={$SERVICE_ID}.\n";
} else {
    echo "Новые элементы для привязки не найдены. Все товары из указанных разделов уже привязаны.\n";
}



*/