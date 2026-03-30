<?
namespace Iw;

use Bitrix\Main\Loader;

class Agent
{
    public static function brandSetterAgent()
    {
        if (file_exists("/home/w/w61226y2/dev.w61226y2.beget.tech/public_html/upload/1c_import_complete.txt")) {
            if (Loader::includeModule('iblock') && Loader::includeModule('catalog')) {

                $arParams = ["replace_space" => "_", "replace_other" => "_"];
                $manufacturerName = "";

                $productObj = \CIBlockElement::GetList(
                    [],
                    [
                        'IBLOCK_ID' => 21,
                        'ACTIVE' => 'Y',
                        '!PROPERTY_CML2_MANUFACTURER' => false,
                        'PROPERTY_BRAND' => false,
                    ],
                    false,
                    false,
                    ['IBLOCK_ID', 'ID', 'NAME', 'PROPERTY_CML2_MANUFACTURER']
                );

                while ($product = $productObj->Fetch()) {
                    $brandId = 0;
                    $manufacturerName = $product['PROPERTY_CML2_MANUFACTURER_VALUE'];
                    if (!empty($manufacturerName)) {
                        $code = \Cutil::translit($manufacturerName, "ru", $arParams);
                        $brandsObj = \CIBlockElement::GetList(
                            [],
                            [
                                "IBLOCK_ID" => 29,
                                "CODE" => $code,
                            ]
                        );
                        if ($brand = $brandsObj->Fetch()) {
                            $brandId = $brand["ID"];
                        } else {
                            $newEl = new \CIBlockElement;
                            $brandId = $newEl->Add(["NAME" => $manufacturerName, 'IBLOCK_ID' => 29, "CODE" => $code]);
                        }

                        if (!empty($brandId) && $brandId > 0) {
                            \CIBlockElement::SetPropertyValueCode($product["ID"], "BRAND", $brandId);
                        }
                    }
                }
                unlink("/home/w/w61226y2/dev.w61226y2.beget.tech/public_html/upload/1c_import_complete.txt");

                file_put_contents(
                    "/home/w/w61226y2/dev.w61226y2.beget.tech/public_html/upload/debug.txt", "отработала привязка - " . date('d.m.Y H:i') . PHP_EOL, FILE_APPEND
                );
            }
        }
    }
}