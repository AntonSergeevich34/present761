<?php
/* Данным скриптом добавляем связанные товары к услуге Гравировка
	этот скрипт добавляет товары по бренду



// Подключение ядра
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

// Подключение модуля инфоблоков
if (!\Bitrix\Main\Loader::includeModule('iblock')) {
    die("Ошибка подключения модуля 'iblock'.");
}

// Идентификаторы инфоблоков и сущностей
$IBLOCK_SERVICES = 24; // Инфоблок "Услуги"
$IBLOCK_CATALOG = 21;  // Инфоблок "Каталог"
$SERVICE_ID = 17486;   // ID услуги
// $BRAND_ID = 17453;     // ID бренда, по которому выбираем товары
$BRAND_ID = 13044;     
$PROPERTY_CODE = 'LINK_GOODS'; // Код свойства, где хранится привязка
$PROPERTY_BRAND_CODE = 'BRAND'; // Код свойства бренда

// Получение текущих привязанных элементов
$currentLinkedItems = [];
$res = CIBlockElement::GetProperty($IBLOCK_SERVICES, $SERVICE_ID, [], ['CODE' => $PROPERTY_CODE]);
while ($prop = $res->Fetch()) {
    if ($prop['VALUE']) {
        $currentLinkedItems[] = $prop['VALUE'];
    }
}

// Найдём все товары из инфоблока "Каталог", которые принадлежат бренду с ID=17453
$newItems = [];
$elementRes = CIBlockElement::GetList(
    ['SORT' => 'ASC'], // Сортировка
    [
        'IBLOCK_ID' => $IBLOCK_CATALOG,
        'ACTIVE' => 'Y',
        'PROPERTY_' . $PROPERTY_BRAND_CODE => $BRAND_ID // Фильтр по бренду
    ],
    false,
    false,
    ['ID']
);

while ($element = $elementRes->Fetch()) {
    if (!in_array($element['ID'], $currentLinkedItems)) {
        $newItems[] = $element['ID'];
    }
}

// Добавляем новые элементы, если они найдены
if (!empty($newItems)) {
    $updatedLinkedItems = array_merge($currentLinkedItems, $newItems);

    // Сохраняем обновленный список привязок
    CIBlockElement::SetPropertyValuesEx($SERVICE_ID, $IBLOCK_SERVICES, [
        $PROPERTY_CODE => $updatedLinkedItems
    ]);

    echo "Новые товары (" . implode(', ', $newItems) . ") успешно добавлены к услуге с ID={$SERVICE_ID}.\n";
} else {
    echo "Нет доступных новых товаров для добавления. Все товары бренда с ID={$BRAND_ID} уже привязаны.\n";
} 




*/
