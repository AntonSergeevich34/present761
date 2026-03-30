<?
namespace Iw;

class Sale
{
	public static function getBasketItems($id)
	{
		$dbBasketTmp = CSaleBasket::GetList(
            ["NAME" => "ASC"],
            ["ORDER_ID" => $id],
            false,
            false,
            ["ID", "NAME", "QUANTITY", "PRODUCT_ID", "PRICE", "DISCOUNT_PRICE"]
        );

		$basketItems = [];
        while ($arBasketTmp = $dbBasketTmp->Fetch()) {
            $basketItems[] = $arBasketTmp;
        }

        return $basketItems;
	}
}
