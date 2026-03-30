<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

\Bitrix\Main\Loader::includeModule('iblock');

$elements = \Bitrix\Iblock\Elements\ElementCatalogTable::getList(array(
	'order' => array('SORT' => 'ASC'), // сортировка
	'select' => array('ID', 'NAME'), // выбираемые поля, без свойств. Свойства можно получать на старом ядре \CIBlockElement::getProperty
	'filter' => array('IBLOCK_ID' => 21, 'IBLOCK_SECTION_ID' => [372, 371, 370],  /* "BRAND" => 13052 */), // фильтр только по полям элемента, свойства (PROPERTY) использовать нельзя
	'group' => array('TAGS'), // группировка по полю, order должен быть пустой
	'limit' => 1000, // целое число, ограничение выбираемого кол-ва
	'offset' => 0, // целое число, указывающее номер первого столбца в результате
	'count_total' => 1, // дает возможность получить кол-во элементов через метод getCount()
	'runtime' => array(), // массив полей сущности, создающихся динамически
	'data_doubling' => false, // разрешает получение нескольких одинаковых записей
	'cache' => array( // Кеш запроса. Сброс можно сделать методом \Bitrix\Iblock\ElementTable::getEntity()->cleanCache();
		'ttl' => 3600, // Время жизни кеша
		'cache_joins' => true // Кешировать ли выборки с JOIN
	),
))->fetchAll();


foreach ($elements as $elem) {

	/* 	echo '<pre>';
		var_dump($elem);
		echo '</pre>'; */
/* 		CIBlockElement::SetPropertyValuesEx($elem['ID'], false, array('EXPANDABLES' => [15961, 7329, 7586, 15751, 16587]));
 */

}

use \Bitrix\Sale\Order;

$order = Order::load(477);
        
        $orderDelivery = $order->getDeliveryPrice();
        $price = $order->getPrice();

        $arDeliv = \CSaleDelivery::GetByID($order->getField("DELIVERY_ID"));
        $arPaySystem = \CSalePaySystem::GetByID($order->getPaymentSystemId());
        
		echo '<pre>';
		var_dump($order->getPaymentSystemId(),$arPaySystem);
		echo '</pre>';
        $arFields["ORDER_LIST_WITH_ARTICLE"] = self::getTablesBasket($order);
        $arFields["ORDER_DISCOUNT_PRICE"] = CurrencyFormat($sumDiscount, "RUB");
        $arFields["ORDER_DELIVERY_PRICE"] = CurrencyFormat($orderDelivery, "RUB");
        $arFields["ORDER_PRICE_PRODUCT"] = CurrencyFormat(($price - $orderDelivery), "RUB");
        $arFields["ORDER_PRISE_WITHOUT_DISCOUNT"] = CurrencyFormat(($arFields["PRICE"] + $arFields["DISCOUNT_PRICE"]), "RUB");
        
        $arFields["ORDER_DESCRIPTION"] = $order->getField("USER_DESCRIPTION");
        $arFields["DELIVERY_NAME"] = $arDeliv["NAME"] ?: '';
        $arFields["PAY_SYSTEM_NAME"] = $arPaySystem["NAME"] ?: '';
        $arFields["PHONE"] = $arInfoUser["PHONE"];
        $arFields["FULL_ADDRESS"] = $arInfoUser["FULL_ADDRESS"];

        if (!empty($_SESSION['USER_UTM'])) {
            $arFields['UTM'] = "UTM метка: " . $_SESSION['USER_UTM'];
        }





/* echo '<pre>';
var_dump( $prodArr);
echo '</pre>'; */
/* echo '<pre>';
var_dump($prodArr);
echo '</pre>'; */
/* CIBlockElement::SetPropertyValuesEx(17486, false, array('LINK_GOODS' => $prodArr)); */
