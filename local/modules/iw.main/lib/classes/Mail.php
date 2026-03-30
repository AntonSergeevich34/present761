<?

namespace Iw;

use Iw\Basket;
use Iw\Options\CustomSettings;
use \Bitrix\Sale\Order;
use \Bitrix\Sale\Helpers\Admin;

class Mail
{   
    public static function oneClickBuy(&$arFields)
    {
        self::templateMailOrder($arFields["RS_ORDER_ID"], $arFields);
    }

    public static function saleNewOrder(&$arFields, $orderID)
    {
        self::templateMailOrder($orderID, $arFields);
    }   

    public static function templateMailOrder($orderID, &$arFields)
    {
        $order = Order::load($orderID);
        
        $orderDelivery = $order->getDeliveryPrice();
        $price = $order->getPrice();

        $arDeliv = \CSaleDelivery::GetByID($order->getField("DELIVERY_ID"));
        $arPaySystem = \CSalePaySystem::GetByID($order->getPaymentSystemId());
        $arInfoUser = self::getOrderUserInfo($order);

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
    }

    public static function getOrderUserInfo($order)
    {
        $dbProp = \CSaleOrderPropsValue::GetOrderProps($order->getId());
        $info = [];

        while ($arProps = $dbProp->Fetch()) {
            if ($arProps["CODE"] == "PHONE") {
                $info["PHONE"] = htmlspecialchars($arProps["VALUE"]);
            }

            if ($arProps["CODE"] == "LOCATION") {
                $arLocs = \CSaleLocation::GetByID($arProps["VALUE"]);
                $info["COUNTRY_NAME"] = $arLocs["COUNTRY_NAME_ORIG"];
                $info["CITY_NAME"] = $arLocs["CITY_NAME_ORIG"];
            }

            if ($arProps["CODE"] == "ZIP") {
                $info["INDEX"] = $arProps["VALUE"];
            }

            if ($arProps["CODE"] == "ADDRESS") {
                $info["ADDRESS"] = $arProps["VALUE"];
            }
        }

        $info["FULL_ADDRESS"] = $info["INDEX"] . ", " . $info["COUNTRY_NAME"] . "-" . $info["CITY_NAME"] . ", " . $info["ADDRESS"];

        return $info;
    }

    public static function getTablesBasket($order)
    {
        $article = "";
        $discount = "";
        $basketItems = Basket::getBasketItems($order->getId());
        $discounts = Admin\OrderEdit::getOrderedDiscounts($order, false);
        $tableBaskets = "<table border='1' style = 'border-collapse: collapse; text-transform: none; font-weight: normal;'><tr><td style = 'padding:7px; text-align: center;'>Изображение товара</td><td style = 'padding:7px'>Описание</td><td style = 'padding:7px'>Артикул</td><td style = 'padding:7px'>Кол-во</td><td style = 'padding:7px'>Ед. измерения</td><td style = 'padding:7px'>Скидка</td><td style = 'padding:7px; text-align: center;'>Цена со скидкой</td></tr>";

        foreach ($basketItems as $basketItem) {
            $dbProps = \CIBlockElement::GetProperty(
                CustomSettings::returnCatalogIblockID(), 
                $basketItem["PRODUCT_ID"], 
                ["sort" => "asc"], 
                ["CODE" => "CML2_ARTICLE"]
            );

            $props = $dbProps->Fetch();
            
            if (!empty($props["VALUE"])) {
                $article = $props["VALUE"];
            } else {
                $article = 'не указан';
            }

            $dbEl = \CIBlockElement::GetByID($basketItem['PRODUCT_ID']);

            if ($el = $dbEl->GetNext()) {
                $productURL = $el['DETAIL_PAGE_URL'];
                $imagepath = \CFile::GetPath($el['DETAIL_PICTURE']);

                if (empty($imagepath)) {
                    $imagepath = CustomSettings::returnPathNonImage();
                }
            }


            $arMeasure = \Bitrix\Catalog\ProductTable::getCurrentRatioWithMeasure($basketItem["PRODUCT_ID"]);

            foreach ($arMeasure as $value) {
                $edinici_izmereniya = $value["MEASURE"]["MEASURE_TITLE"];
            }

            foreach ($discounts[$basketItem["ID"]] as $el) {
                $discount .= $result["DISCOUNTS_LIST"]["DISCOUNT_LIST"][$el["DISCOUNT_ID"]]["NAME"] . ": ";
                $discount .= \CurrencyFormat(floatval($basketItem["DISCOUNT_PRICE"]), "RUB") . ';<br>';
            }

            $sumDiscount += $basketItem["DISCOUNT_PRICE"] * $basketItem["QUANTITY"];

            $tableBaskets .= "<tr><td style = 'padding:7px; text-align: center;'><img style='width:100px' src='http://present61.ru" . $imagepath . "'></td>";
            $tableBaskets .= "<td style = 'padding:7px'><a href = 'http://present61.ru" . $productURL . "'>" . $basketItem["NAME"] . "</a></td>";
            $tableBaskets .= "<td style = 'padding:7px; text-align: center;'>" . $article . "</td>";
            $tableBaskets .= "<td style = 'padding:7px; text-align: center;'>" . $basketItem["QUANTITY"] . "</td>";
            $tableBaskets .= "<td style = 'padding:7px; text-align: center;'>" . $edinici_izmereniya . "</td>";
            $tableBaskets .= "<td style = 'padding:7px; text-align: center;'>" . $discount . "</td>";
            $tableBaskets .= "<td style = 'padding:7px; text-align: center; white-space: nowrap;' >" . \CurrencyFormat($basketItem["PRICE"], "RUB") . "</td></tr>";
        }

        $tableBaskets .= "</table>";

        return $tableBaskets;
    }
}