<?php
$postData = file_get_contents('php://input');

if (!isset($postData) || !$postData) {
    // Проверка наличия тела запроса
    http_response_code(400);
    echo 'Empty request body';
    exit;
}

$reqData = json_decode($postData, true);

if (empty($reqData) || !$reqData) {
    // Проверка наличия пароля в запросе
    http_response_code(400);
    echo 'Empty request body';
    exit;
}

$json = file_get_contents(__DIR__ . '/data.json');
$data = json_decode($json, true);
$data[] = $reqData;
$dataJson = json_encode($data, JSON_UNESCAPED_UNICODE);

$writeResult = file_put_contents(__DIR__ . '/data.json', $dataJson);

if ($writeResult) {
    http_response_code(200);
    echo 'Data saved';
    exit;
} else {
    http_response_code(500);
    echo 'Internal server error';
    exit;
}