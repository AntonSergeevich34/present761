<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
\Bitrix\Main\Loader::includeModule('iblock');

$IBLOCK_PRODUCTS = 21;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 400; // товаров за проход
$offset = ($page - 1) * $perPage;

$res = CIBlockElement::GetList(
    ['ID' => 'ASC'],
    ['IBLOCK_ID' => $IBLOCK_PRODUCTS],
    false,
    ['nPageSize' => $perPage, 'iNumPage' => $page],
    ['ID']
);

$el = new CIBlockElement;

$count = 0;

while ($item = $res->Fetch()) {

    $id = $item['ID'];

    $result = $el->Update($id, []);

    if ($result) {
        echo "✔ Товар {$id} пересохранён<br>";
    } else {
        echo "❌ Ошибка товара {$id}: " . $el->LAST_ERROR . "<br>";
    }

    usleep(200000); // 0.2 сек
    $count++;
}

echo "<hr>";
echo "Готово! На странице {$page} пересохранено товаров: {$count}<br>";

if ($count > 0) {
    $nextPage = $page + 1;
    echo "<a href=\"?page={$nextPage}\">Следующая страница →</a>";
} else {
    echo "Все товары пересохранены!";
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/epilog_after.php");
