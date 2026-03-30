<?php

namespace Iw\Options;

use \Bitrix\Main\Config\Option;

class CustomSettings
{
    const MODULE_NAME = "grain.customsettings";

    public static function returnCatalogIblockID()
    {
        return Option::get(self::MODULE_NAME, "CATALOG_IBLOCK_ID");
    }

    public static function returnPathNonImage()
    {
        return Option::get(self::MODULE_NAME, "PATH_NON_IMAGE");
    }
}