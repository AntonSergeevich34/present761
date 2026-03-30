<?
namespace Iw\Events;

use Iw\Catalog;

class CatalogEventHandlers
{
    public static function onCompleteCatalogImport1CHandler()
    {
        Catalog::addCompleteCatalogImportFlag();
    }
}