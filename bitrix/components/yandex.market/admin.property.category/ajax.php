<?php

use Bitrix\Main;
use Yandex\Market\Reference\Assert;
use Yandex\Market\Utils\HttpResponse;
use Yandex\Market\Components;

require_once $_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php';

try
{
    if (!Main\Loader::includeModule('yandex.market'))
    {
        throw new Main\SystemException('Module yandex.market is required');
    }

    require_once './class.php';

    $request = Main\Application::getInstance()->getContext()->getRequest();
	$request->addFilter(new Main\Web\PostDecodeFilter());

    $action = $request->getPost('action');
    $query = $request->getPost('query');
    $parameters = $request->getPost('parameters');

    if (!is_array($parameters)) { $parameters = []; }

    Assert::notNull($action, 'request[action]');
    Assert::notNull($query, 'request[query]');

	$component = new Components\AdminPropertyCategory();
    $method = $action . 'Action';

    Assert::methodExists($component, $method);

    $responseData = $component->$method($query, $parameters);

    $response = [
        'status' => 'ok',
        'data' => $responseData,
    ];
}
catch (Main\SystemException $e)
{
    $response = [
        'status' => 'error',
        'message' => $e->getMessage(),
    ];
}

HttpResponse::sendJson($response);
