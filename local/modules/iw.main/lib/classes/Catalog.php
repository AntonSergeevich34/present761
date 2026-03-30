<?
namespace Iw;

class Catalog
{
	public static function addCompleteCatalogImportFlag()
    {
        file_put_contents($_SERVER["DOCUMENT_ROOT"]."/upload/1c_import_complete.txt", "1c_import_complete - ".date('d.m.Y H:i'));

        \CAgent::AddAgent(
            "\Iw\Agent::brandSetterAgent();",                  // имя функции
            "iblock",                               // идентификатор модуля
            "N",                                    // агент не критичен к кол-ву запусков
            60,                                     // интервал запуска
            "",                                     // дата первой проверки на запуск
            "Y",                                    // агент активен
            ConvertTimeStamp(time()+60, "FULL"),    // дата первого запуска
            30
        );
    }
}