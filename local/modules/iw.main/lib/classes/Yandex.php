<?
namespace Iw;
use Iw\Options\CustomSettings;

use Bitrix\Main\Loader;
class YandexPrice
{

	public static function yandexPriceList(&$event){
		$iblockID = CustomSettings::returnCatalogIblockID();
		if (Loader::includeModule('catalog')) {
			// @var $tagResultList Market\Result\XmlNode[] */
			// @var $tagElement \SimpleXMLElement */

			$tagResultList = $event->getParameter('TAG_RESULT_LIST');
			$context = $event->getParameter('CONTEXT');
			
			foreach ($tagResultList as $elementId => $tagResult) {
				if ($tagResult->isSuccess()) {
					$tagNode = $tagResult->getXmlElement();
					$attributeList = $tagNode->attributes();

					switch ($context["SETUP_ID"]) {
						case '1':
							if (strpos($tagNode->name, 'зажигалка') !== false) {
								$tagNode->name = str_replace('зажигалка', 'средство для розжига', $tagNode->name);
							} elseif(strpos($tagNode->name, 'Зажигалка') !== false) {
								$tagNode->name = str_replace('Зажигалка', 'Средство для розжига', $tagNode->name);
							}
							
							if ($tagNode->price < 800) {
								$tagNode->price = 800;
							}

							$tagNode->price *= 1.2;

							break;
						case '2':
							$prop = \CIBlockElement::GetProperty(
								$iblockID, 
								$attributeList["id"], 
								["sort" => "asc"], 
								["CODE"=>"ALI_MARKUP", "EMPTY" => "N"]
							);
							if($arProp = $prop->Fetch()) {
								$tagNode->price += $arProp["VALUE"];
							} 

							if ($tagNode->price < 600) {
								$tagNode->price = 600;
							}	

							break;
					}
				}
			}
		}
	}
}

