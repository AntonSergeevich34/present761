<?
namespace Iw\Events;

use Iw\YandexPrice;
use Bitrix\Main;

class YandexEventHandlers
{
    public static function onExportOfferWriteDataHandler(Main\Event $event)
	{
		YandexPrice::YandexPriceList($event);
	}
};