<?
namespace Aspro\Functions;

use Bitrix\Main\Application;
use Bitrix\Main\Web\DOM\Document;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Web\DOM\CssParser;
use Bitrix\Main\Text\HtmlFilter;
use Bitrix\Main\IO\File;
use Bitrix\Main\IO\Directory;

Loc::loadMessages(__FILE__);
\Bitrix\Main\Loader::includeModule('sale');
\Bitrix\Main\Loader::includeModule('catalog');

//user custom functions

if(!class_exists("CAsproMaxCustom"))
{
	class CAsproMaxCustom{
		const MODULE_ID = \CMax::moduleID;


		public static function showSectionImg($arParams = array(), $arItems = array(), $bIcons = false)
		{
			if($arItems):?>
				<?ob_start();?>
					<?if($bIcons && $arItems["UF_CATALOG_ICON"]):?>
						<?$img = \CFile::ResizeImageGet($arItems["UF_CATALOG_ICON"], array( "width" => 40, "height" => 40 ), BX_RESIZE_IMAGE_EXACT, true );?>
						<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb">
							<?if(strpos($img["src"], ".svg") !== false):?>
								<?=file_get_contents($_SERVER["DOCUMENT_ROOT"].$img["src"]);?>
							<?else:?>
								<img class="lazy img-responsive" data-src="<?=$img["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($img["src"]);?>" alt="<?=($arItems["PICTURE"]["ALT"] ? $arItems["PICTURE"]["ALT"] : $arItems["NAME"])?>" title="<?=($arItems["PICTURE"]["TITLE"] ? $arItems["PICTURE"]["TITLE"] : $arItems["NAME"])?>" />
							<?endif;?>
						</a>
					<?else:?>
						<?if($arItems["PICTURE"]["SRC"]):?>
								<?$img = \CFile::ResizeImageGet($arItems["PICTURE"]["ID"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
								<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb"><img class="lazy img-responsive" data-src="<?=$img["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($img["src"]);?>" alt="<?=($arItems["PICTURE"]["ALT"] ? $arItems["PICTURE"]["ALT"] : $arItems["NAME"])?>" title="<?=($arItems["PICTURE"]["TITLE"] ? $arItems["PICTURE"]["TITLE"] : $arItems["NAME"])?>" /></a>
							<?elseif($arItems["~PICTURE"]):?>
								<?$img = \CFile::ResizeImageGet($arItems["~PICTURE"], array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );?>
								<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb"><img class="lazy img-responsive" data-src="<?=$img["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($img["src"]);?>" alt="<?=($arItems["PICTURE"]["ALT"] ? $arItems["PICTURE"]["ALT"] : $arItems["NAME"])?>" title="<?=($arItems["PICTURE"]["TITLE"] ? $arItems["PICTURE"]["TITLE"] : $arItems["NAME"])?>" /></a>
							<?else:?>
							<?
								$res = \CIBlockElement::GetList(
								    Array(),
								    Array("SECTION_ID" => $arItems["ID"], "INCLUDE_SUBSECTIONS" => "Y",array("LOGIC" => "OR", array("!PREVIEW_PICTURE" => false), array("!DETAIL_PICTURE" => false))),
								    false,
								    false,
								    Array()
								);
								$imgId = "";
								if($element = $res->Fetch()){
									$imgId = !empty($element["PREVIEW_PICTURE"]) ? $element["PREVIEW_PICTURE"] : $element["DETAIL_PICTURE"];
								}
								if (!empty($imgId)) {
									$img = \CFile::ResizeImageGet($imgId, array( "width" => 120, "height" => 120 ), BX_RESIZE_IMAGE_EXACT, true );
								}
								if (!empty($img)) {?>
									<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb"><img class="lazy img-responsive" data-src="<?=$img["src"]?>" src="<?=\Aspro\Functions\CAsproMax::showBlankImg($img["src"]);?>" alt="<?=($arItems["PICTURE"]["ALT"] ? $arItems["PICTURE"]["ALT"] : $arItems["NAME"])?>" title="<?=($arItems["PICTURE"]["TITLE"] ? $arItems["PICTURE"]["TITLE"] : $arItems["NAME"])?>" /></a>
								<?}else{?>
									<a href="<?=$arItems["SECTION_PAGE_URL"]?>" class="thumb"><img class="lazy img-responsive" data-src="<?=SITE_TEMPLATE_PATH?>/images/svg/noimage_product.svg" src="<?=\Aspro\Functions\CAsproMax::showBlankImg(SITE_TEMPLATE_PATH.'/images/svg/noimage_product.svg');?>" alt="<?=$arItems["NAME"]?>" title="<?=$arItems["NAME"]?>" /></a>
								<?}?>


						<?endif;?>
					<?endif;?>
				<?$html = ob_get_contents();
				ob_end_clean();

				foreach(GetModuleEvents('aspro.max', 'OnAsproShowSectionImg', true) as $arEvent) // event for manipulation item img
					ExecuteModuleEventEx($arEvent, array($arParams, $arItem, $bShowFW, &$html));

				echo $html;?>
			<?endif;?>
		<?}

		public static function OnBeforeUserUpdateHandler($arFields)
		{
			if ($arFields['EMAIL'] === 'demo@aspro.ru' && $arFields['LOGIN'] === 'demo@aspro.ru' && !$GLOBALS['USER']->IsAdmin()) {
				global $APPLICATION;
				$APPLICATION->throwException(Loc::getMessage("USER_FORBIDDEN_UPDATE_PROFILE"));
				return false;
			}
		}


        public static function setPageDetail($pageDetailFile)
        {
            global $arTheme;
            $bSettedThemeValues = ((isset($_SESSION['THEME']) && $_SESSION['THEME']) && (isset($_SESSION['THEME'][SITE_ID]) && $_SESSION['THEME'][SITE_ID]));
            if (!$bSettedThemeValues) {
                unset($_COOKIE['current_page_detail']);
            }

            if ($_COOKIE['current_page_detail'] && $bSettedThemeValues && $arTheme['CATALOG_PAGE_DETAIL']) {
                if (in_array($_COOKIE['current_page_detail'], array_keys($arTheme['CATALOG_PAGE_DETAIL']['LIST']))) {
                    $pageDetailFile = $_COOKIE['current_page_detail'];
                }
            }
            return $pageDetailFile;
        }
	}

}?>