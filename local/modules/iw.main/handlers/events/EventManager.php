<?php

/**
 * Класс в котором будут собраны вызовы всех событий, чтобы не писать простыню в init.php
 */

namespace Iw\Events;


class EventManager
{
    public function initEvents()
    {
        $bxEventManager = \Bitrix\Main\EventManager::getInstance();

        /*start События модуля MAIN */
        $bxEventManager->addEventHandler(
            "main",
            "OnBeforeEventAdd",
            [
                "Iw\Events\MainEventHandlers",
                "onBeforeEventAddHandler",
            ]
        );
       


        $bxEventManager->addEventHandler(
            "main",
            "OnPageStart",
            [
                "Iw\Events\MainEventHandlers",
                "onPageStartHandler",
            ]
        );
        /*end  События модуля MAIN */


        /*start События модуля SALE */
        $bxEventManager->addEventHandler(
            "sale",
            "OnOrderNewSendEmail",
            [
                "Iw\Events\SaleEventHandlers",
                "onOrderNewSendEmailHandler",
            ]
        );
        /*end События модуля SALE */

        /*start События модуля CATALOG */
        $bxEventManager->addEventHandler(
            "catalog",
            "OnCompleteCatalogImport1C",
            [
                "Iw\Events\CatalogEventHandlers",
                "onCompleteCatalogImport1CHandler",
            ]
        );
        /*end События модуля CATALOG */

        /*start События модуля IBLOCK*/
        /*end События модуля IBLOCK*/



         /*start События модуля YANDEX*/
         $bxEventManager->addEventHandler(
            "yandex.market",
            "onExportOfferWriteData",
            [
                "Iw\Events\YandexEventHandlers",
                "onExportOfferWriteDataHandler",
            ]
        );
          /*end События модуля YANDEX*/
    }
}
