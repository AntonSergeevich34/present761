<?
namespace Iw\Events;

use Iw\Mail;

class SaleEventHandlers
{
    public static function onOrderNewSendEmailHandler($orderID, &$eventName, &$arFields)
    {
        if ($eventName == "SALE_NEW_ORDER") {
            Mail::saleNewOrder($arFields, $orderID);
        }
    }
}