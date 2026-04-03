<?php
define('NO_KEEP_STATISTIC', true);
define('NO_AGENT_STATISTIC', true);
define('NO_AGENT_CHECK', true);
define('DisableEventsCheck', true);
define('NOT_CHECK_PERMISSIONS', true);

use Bitrix\Main\Loader;

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

@set_time_limit(0);
@ignore_user_abort(true);

if (!Loader::includeModule('iblock')) {
    http_response_code(500);
    echo 'Module iblock is not available';
    exit;
}

$iblockId = 21;
$limit = isset($_GET['limit']) ? max(1, min(500, (int)$_GET['limit'])) : 100;
$lastId = isset($_GET['last_id']) ? max(0, (int)$_GET['last_id']) : 0;
$sleepUs = isset($_GET['sleep_us']) ? max(0, min(500000, (int)$_GET['sleep_us'])) : 100000;
$run = isset($_GET['run']) ? (string)$_GET['run'] === '1' : true;
$auto = isset($_GET['auto']) ? (string)$_GET['auto'] === '1' : false;
$delay = isset($_GET['delay']) ? max(1, min(30, (int)$_GET['delay'])) : 2;
$step = isset($_GET['step']) ? max(1, (int)$_GET['step']) : 1;
$maxSteps = isset($_GET['max_steps']) ? max(1, min(500, (int)$_GET['max_steps'])) : 50;

$scriptName = basename(__FILE__);
$logFile = $_SERVER['DOCUMENT_ROOT'] . '/update_preview_from_detail_ib21.log';
$startedAt = date('Y-m-d H:i:s');

$stats = [
    'selected' => 0,
    'updated' => 0,
    'skipped_no_detail' => 0,
    'skipped_file_error' => 0,
    'errors' => 0,
];

$nextLastId = $lastId;
$messages = [];
$element = new CIBlockElement();

function writeLog($logFile, $message)
{
    file_put_contents($logFile, '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL, FILE_APPEND);
}

function addMessage(&$messages, $message)
{
    $messages[] = $message;
}

writeLog(
    $logFile,
    "=== Start batch: iblock=21, last_id={$lastId}, limit={$limit}, run=" . ($run ? '1' : '0') . ", auto=" . ($auto ? '1' : '0') . ", step={$step}/{$maxSteps} ==="
);

$res = CIBlockElement::GetList(
    ['ID' => 'ASC'],
    [
        'IBLOCK_ID' => $iblockId,
        'ACTIVE' => 'Y',
        '>ID' => $lastId,
    ],
    false,
    ['nTopCount' => $limit],
    ['ID', 'NAME', 'DETAIL_PICTURE', 'PREVIEW_PICTURE']
);

while ($item = $res->Fetch()) {
    $stats['selected']++;
    $nextLastId = (int)$item['ID'];

    $itemId = (int)$item['ID'];
    $itemName = (string)$item['NAME'];
    $detailPictureId = (int)$item['DETAIL_PICTURE'];

    if ($detailPictureId <= 0) {
        $stats['skipped_no_detail']++;
        $message = "SKIP #{$itemId} {$itemName}: no DETAIL_PICTURE";
        addMessage($messages, $message);
        writeLog($logFile, $message);
        continue;
    }

    $fileArray = CFile::MakeFileArray($detailPictureId);
    if (!$fileArray || empty($fileArray['tmp_name'])) {
        $stats['skipped_file_error']++;
        $message = "SKIP #{$itemId} {$itemName}: failed to build file array from DETAIL_PICTURE {$detailPictureId}";
        addMessage($messages, $message);
        writeLog($logFile, $message);
        continue;
    }

    $fileArray['MODULE_ID'] = 'iblock';
    $fileArray['old_file'] = (int)$item['PREVIEW_PICTURE'];
    $fileArray['del'] = 'N';

    if (!$run) {
        $message = "DRY #{$itemId} {$itemName}: PREVIEW_PICTURE <= DETAIL_PICTURE {$detailPictureId}";
        addMessage($messages, $message);
        writeLog($logFile, $message);
        continue;
    }

    $result = $element->Update($itemId, ['PREVIEW_PICTURE' => $fileArray], false, false, true);

    if ($result) {
        $stats['updated']++;
        $message = "OK #{$itemId} {$itemName}: PREVIEW_PICTURE updated from DETAIL_PICTURE {$detailPictureId}";
        addMessage($messages, $message);
        writeLog($logFile, $message);
    } else {
        $stats['errors']++;
        $error = trim((string)$element->LAST_ERROR);
        $message = "ERROR #{$itemId} {$itemName}: " . ($error !== '' ? $error : 'unknown error');
        addMessage($messages, $message);
        writeLog($logFile, $message);
    }

    if ($sleepUs > 0) {
        usleep($sleepUs);
    }
}

$hasNext = $stats['selected'] === $limit;
$canAutoContinue = $hasNext && $auto && $step < $maxSteps;
$nextQuery = http_build_query([
    'last_id' => $nextLastId,
    'limit' => $limit,
    'sleep_us' => $sleepUs,
    'run' => $run ? '1' : '0',
    'auto' => $auto ? '1' : '0',
    'delay' => $delay,
    'step' => $step + 1,
    'max_steps' => $maxSteps,
]);
$nextUrlRaw = '/' . $scriptName . '?' . $nextQuery;
$nextUrl = htmlspecialcharsbx($nextUrlRaw);

writeLog(
    $logFile,
    "=== Finish batch: selected={$stats['selected']}, updated={$stats['updated']}, skipped_no_detail={$stats['skipped_no_detail']}, skipped_file_error={$stats['skipped_file_error']}, errors={$stats['errors']}, next_last_id={$nextLastId} ==="
);

header('Content-Type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <?php if ($canAutoContinue): ?>
        <meta http-equiv="refresh" content="<?= $delay ?>;url=<?= $nextUrl ?>">
    <?php endif; ?>
    <title>Обновление PREVIEW_PICTURE из DETAIL_PICTURE</title>
    <style>
        body { font: 14px/1.5 Arial, sans-serif; margin: 24px; color: #222; }
        h1 { margin-bottom: 12px; }
        .summary { margin-bottom: 20px; padding: 16px; border: 1px solid #ddd; background: #fafafa; }
        .summary div { margin-bottom: 4px; }
        .actions { margin: 16px 0 24px; }
        a { color: #0b57d0; text-decoration: none; }
        a:hover { text-decoration: underline; }
        pre { white-space: pre-wrap; word-break: break-word; padding: 16px; background: #111; color: #f5f5f5; border-radius: 6px; }
    </style>
</head>
<body>
    <h1>Обновление PREVIEW_PICTURE из DETAIL_PICTURE</h1>

    <div class="summary">
        <div><strong>Инфоблок:</strong> <?= $iblockId ?></div>
        <div><strong>Старт:</strong> <?= htmlspecialcharsbx($startedAt) ?></div>
        <div><strong>Режим:</strong> <?= $run ? 'боевой' : 'dry-run' ?></div>
        <div><strong>Пакет:</strong> <?= $limit ?></div>
        <div><strong>Автозапуск:</strong> <?= $auto ? 'включен' : 'выключен' ?></div>
        <div><strong>Шаг:</strong> <?= $step ?> / <?= $maxSteps ?></div>
        <div><strong>Стартовый last_id:</strong> <?= $lastId ?></div>
        <div><strong>Обработано в выборке:</strong> <?= $stats['selected'] ?></div>
        <div><strong>Обновлено:</strong> <?= $stats['updated'] ?></div>
        <div><strong>Пропущено без DETAIL_PICTURE:</strong> <?= $stats['skipped_no_detail'] ?></div>
        <div><strong>Пропущено из-за ошибки файла:</strong> <?= $stats['skipped_file_error'] ?></div>
        <div><strong>Ошибок обновления:</strong> <?= $stats['errors'] ?></div>
        <div><strong>Лог-файл:</strong> <?= htmlspecialcharsbx($logFile) ?></div>
        <div><strong>Следующий last_id:</strong> <?= $nextLastId ?></div>
    </div>

    <div class="actions">
        <?php if ($canAutoContinue): ?>
            Следующий пакет запустится автоматически через <?= $delay ?> сек.
            <br><a href="<?= $nextUrl ?>">Запустить следующий пакет сразу</a>
        <?php elseif ($hasNext): ?>
            <a href="<?= $nextUrl ?>">Запустить следующий пакет</a>
        <?php else: ?>
            Обработка завершена, новых элементов в текущем диапазоне не найдено.
        <?php endif; ?>
        <br><br>
        <a href="<?= htmlspecialcharsbx('/' . $scriptName . '?last_id=' . $lastId . '&limit=' . $limit . '&sleep_us=' . $sleepUs . '&run=' . ($run ? '1' : '0') . '&auto=1&delay=' . $delay . '&step=1&max_steps=' . $maxSteps) ?>">Запустить авто-режим с текущей точки</a>
    </div>

    <pre><?= htmlspecialcharsbx(implode(PHP_EOL, $messages)) ?></pre>
</body>
</html>
