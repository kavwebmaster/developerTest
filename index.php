<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


$result = Project\Helpers\IblockElementHelper::getCachedList([
    'filter' => [
        'IBLOCK_ID' => 1
    ],
    'select' => ['NAME', 'ID']
], 3600, function ($el){
    $el['name'] = ToLower($el['NAME']).randString(10);
    return $el;
});

dump($result);