<?php

use Bitrix\Main\Loader;

Loader::registerAutoLoadClasses(
    'iw.main',
    [
        /*обработчики*/
        'Iw\Events\EventManager' => 'handlers/events/EventManager.php',
        'Iw\Events\MainEventHandlers' => 'handlers/main/MainEventHandlers.php',
        'Iw\Events\SaleEventHandlers' => 'handlers/sale/SaleEventHandlers.php',
        'Iw\Events\CatalogEventHandlers' => 'handlers/sale/CatalogEventHandlers.php',
        'Iw\Events\YandexEventHandlers' => 'handlers/yandex.market/YandexEventHandlers.php',

        
        'Iw\Main' => 'lib/classes/Main.php',
        'Iw\Mail' => 'lib/classes/Mail.php',
        'Iw\Catalog' => 'lib/classes/Catalog.php',
        'Iw\Basket' => 'lib/classes/Basket.php',
        'Iw\Agent' => 'lib/classes/Agent.php',
        'Iw\YandexPrice' => 'lib/classes/Yandex.php',
        'Iw\Options\CustomSettings' => 'lib/options/CustomSettings.php',
    ]
);
