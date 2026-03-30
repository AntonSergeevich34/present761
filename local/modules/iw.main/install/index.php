<?php

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Main\EventManager;

class iw_main extends CModule
{
    var $MODULE_VERSION;
    var $MODULE_VERSION_DATE;
    var $MODULE_NAME;
    var $MODULE_DESCRIPTION;
    var $MODULE_ID = "iw.main";

    public function __construct()
    {
        $arModuleVersion = [];

        include __DIR__ . '/version.php';

        if (is_array($arModuleVersion) && array_key_exists('VERSION', $arModuleVersion)) {
            $this->MODULE_VERSION = $arModuleVersion['VERSION'];
            $this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
        }
 
        $this->MODULE_ID = str_replace("_", ".", get_class($this));

        $this->MODULE_NAME = Loc::getMessage("INSTALL_NAME_IW");
        $this->MODULE_DESCRIPTION = Loc::getMessage("INSTALL_NAME_IW");
        $this->PARTNER_NAME = Loc::getMessage("SPER_PARTNER");
        $this->PARTNER_URI = Loc::getMessage("PARTNER_URI");
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);

        
    }


    public function doUninstall()
    {
        ModuleManager::unregisterModule($this->MODULE_ID);

        
    }
}