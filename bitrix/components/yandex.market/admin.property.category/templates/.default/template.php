<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) { die(); }

use Bitrix\Main;
use Yandex\Market\Ui\Extension;
use Yandex\Market\Ui\UserField\Helper\Attributes;
use Bitrix\Main\Localization\Loc;

/** @var string $templateFolder */
/** @var array $arParams */
/** @var CBitrixComponent $component */
/** @var \CBitrixComponentTemplate $this */

$delayed = ($arParams['DELAYED'] === 'Y');

if ($delayed)
{
    $loaderScripts = Extension::assets('@Ui.AssetsLoader');

    list($loaderStart, $loaderFinish) = explode('#FN#', sprintf(
        'top.BX.loadScript(%s, () => {
            top.BX.YandexMarket.Ui.AssetsLoader.load(%s).then(#FN#);
        });',
        Main\Web\Json::encode($loaderScripts['js']),
        Main\Web\Json::encode([
            'js' => $templateFolder . '/bundle.js',
            'css' => $templateFolder . '/bundle.css',
            'rel' => [ Extension::assets('@lib.select2') ],
        ])
    ));
}
else
{
	Extension::load('@lib.select2');
	$this->addExternalCss($templateFolder . '/bundle.css');
	$this->addExternalJs($templateFolder . '/bundle.js');

    list($loaderStart, $loaderFinish) = explode('#FN#', 'setTimeout(#FN#);');
}

$htmlClass = 'ym-property-category-' . $arParams['PROPERTY_ID'];
$skipInit = ($arParams['SKIP_INIT'] === 'Y');

$addAttributes = isset($arParams['ADDITIONAL_ATTRIBUTES']) ? $arParams['ADDITIONAL_ATTRIBUTES'] : [];

$attributes = Attributes::stringify(array_filter([
    'class' => 'ym-property-category ' . $htmlClass,
    'name' => $arParams['CONTROL_NAME'],
    'multiple' => $arParams['MULTIPLE'] === 'Y',
    'style' => 'width: 600px; max-width: 100%',
]) + $addAttributes);

$options = '';

if ($arParams['ALLOW_NO_VALUE'] !== 'N')
{
    $options = sprintf('<option value="">%s</option>', Loc::getMessage('YANDEX_MARKET_ADMIN_COMPONENT_CATEGORY_NO_VALUE'));
}

$placeholder = Loc::getMessage('YANDEX_MARKET_ADMIN_COMPONENT_CATEGORY_SELECT_PLACEHOLDER');

if (!empty($arParams['PARENT_VALUE']))
{
    $placeholder = is_array($arParams['PARENT_VALUE']) ? implode(', ', $arParams['PARENT_VALUE']) : $arParams['PARENT_VALUE'];
}

if ($arParams['MULTIPLE'] === 'Y')
{
    $values = is_array($arParams['VALUE']) ? $arParams['VALUE'] : [];
}
else
{
    $values = [ $arParams['VALUE'] ];
}

foreach ($values as $value)
{
    if (empty($value)) { continue; }

    $options .= '<option selected>' . $value . '</option>';
}

$html = <<<SELECT
	<select {$attributes}>
		{$options}
	</select>
SELECT;

if ($arParams['COPY_BUTTON'] === 'Y')
{
    $copyTitle = Loc::getMessage('YANDEX_MARKET_ADMIN_COMPONENT_CATEGORY_COPY');

    $html = <<<LAYOUT
		<div class="ym-category-property">
			{$html}
			<button class="ym-category-property__copy" type="button" title="{$copyTitle}" data-entity="copy">{$copyTitle}</button>
		</div>
LAYOUT;
}

if (!$skipInit)
{
    $pluginOptions = Main\Web\Json::encode(array_filter([
        'url' => $component->getPath() . '/ajax.php',
        'parameters' => array_intersect_key($arParams, [
            'PROPERTY_TYPE' => true,
            'PROPERTY_ID' => true,
        ]),
        'language' => LANGUAGE_ID,
        'lang' => [
            'PLACEHOLDER' => $placeholder,
        ],
    ]));

    /** @noinspection JSUnresolvedReference */
    /** @noinspection BadExpressionStatementJS */
    $html .= <<<SCRIPT
        <script>
            top.BX.ready(function() {
                {$loaderStart}function() {
                    const elements = top.document.getElementsByClassName("{$htmlClass}");
                    const readyToken = "ym-category--ready";
                    
                    for (const element of elements) { 
                        if (element.classList.contains(readyToken)) { continue; }
                        
                        new top.BX.YandexMarket.Admin.Property.Category(element, {$pluginOptions})
                        
                        element.classList.add(readyToken);
                    }
                }{$loaderFinish}
            });
        </script>
SCRIPT;
}

$component->arResult['HTML'] = $html;