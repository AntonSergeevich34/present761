<?php
// Подключение ядра Bitrix
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// Сбор остатков товаров в каталоге на сайте и вывод на экран

use Bitrix\Main\Loader;
use Bitrix\Catalog\ProductTable;
use Bitrix\Iblock\ElementTable;

// Подключение модулей catalog и iblock
if (!Loader::includeModule('catalog') || !Loader::includeModule('iblock')) {
    die('Модули catalog и/или iblock не установлены.');
}

// Получение остатков товаров из каталога 1С-Битрикс
$products = [];
$result = ProductTable::getList([
    'select' => ['ID', 'QUANTITY', 'IBLOCK_ELEMENT.NAME'],
    'filter' => ['>QUANTITY' => 0],
    'runtime' => [
        new \Bitrix\Main\Entity\ReferenceField(
            'IBLOCK_ELEMENT',
            ElementTable::class,
            [
                '=this.ID' => 'ref.ID'
            ]
        )
    ]
]);

// Вывод остатков товаров на экран
while ($product = $result->fetch()) {
    echo "Товар: " . $product['IBLOCK_ELEMENT_NAME'] . " (ID: " . $product['ID'] . ") - Остаток: " . $product['QUANTITY'] . "\n";
}
?>
