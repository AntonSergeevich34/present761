<?
namespace Iw\Events;

use Iw\Mail;
use Iw\Main;

class MainEventHandlers
{
	public static function onBeforeEventAddHandler(&$event, &$lid, &$arFields)
    {
        if ($event == "NEW_ONE_CLICK_BUY") {
            Mail::oneClickBuy($arFields);
        }
    }

    public static function onPageStartHandler()
    {
        Main::canonical();
    }
}